<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BinanceApiService
{
    protected string $baseUrl = 'https://api.binance.com/api/v3/ticker/price';

    public function getPrice(string $baseCurrency, string $quoteCurrency): ?float
    {
        $symbol = strtoupper(trim($baseCurrency . $quoteCurrency)); // защитимся от пробелов

        Log::debug(" Собран symbol: {$symbol} из {$baseCurrency} / {$quoteCurrency}");

        try {
            $response = Http::get($this->baseUrl, [
                'symbol' => $symbol,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['price'])) {
                return (float) $data['price'];
            }

            Log::warning("Binance API error for {$symbol}", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Throwable $e) {
            Log::error("Binance API exception for {$symbol}", [
                'error' => $e->getMessage()
            ]);

            return null;
        }
    }
}

