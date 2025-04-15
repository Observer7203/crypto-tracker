<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\CryptoPair;
use App\Models\CryptoRate;
use App\Services\BinanceApiService;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $api = new BinanceApiService;
    $now = now();

    foreach (CryptoPair::where('is_active', true)->get() as $pair) {
        $last = $pair->rates()->latest('timestamp')->first();

        if ($last && $now->diffInMinutes(\Carbon\Carbon::parse($last->timestamp)) < $pair->update_interval) {
            continue;
        }

        $rate = $api->getPrice($pair->base_currency, $pair->quote_currency);
        if ($rate !== null) {
            Log::info("🔥 Прямой крон-обновление: {$pair->base_currency}/{$pair->quote_currency} = {$rate}");

            CryptoRate::create([
                'crypto_pair_id' => $pair->id,
                'rate' => $rate,
                'timestamp' => $now,
            ]);

            $pair->update(['current_price' => $rate]);
        }
    }
})->everyMinute();
