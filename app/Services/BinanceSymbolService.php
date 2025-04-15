<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AvailablePair;

class BinanceSymbolService
{
    protected string $url = 'https://api.binance.com/api/v3/exchangeInfo';

    public function fetchAndStoreSymbols(): void
    {
        try {
            $response = Http::get($this->url);

            if (! $response->successful()) {
                Log::warning('Binance exchangeInfo fetch failed.', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return;
            }

            $data = $response->json();

            foreach ($data['symbols'] as $symbolData) {
                AvailablePair::updateOrCreate(
                    ['symbol' => $symbolData['symbol']],
                    [
                        'base_asset' => $symbolData['baseAsset'],
                        'quote_asset' => $symbolData['quoteAsset'],
                    ]
                );
            }

            Log::info('Binance symbols synced successfully.');
        } catch (\Throwable $e) {
            Log::error('Binance symbol sync error', ['message' => $e->getMessage()]);
        }
    }
}
