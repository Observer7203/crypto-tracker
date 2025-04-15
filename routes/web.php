<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoPairController;
use App\Http\Controllers\CryptoRateController;
use App\Services\BinanceSymbolService;

// Домашняя страница: редирект на /pairs
Route::get('/', fn () => redirect()->route('pairs.index'));

// Управление крипто-парами (CRUD)
Route::resource('pairs', CryptoPairController::class);

// История курсов
Route::get('/rates', [CryptoRateController::class, 'index'])->name('rates.index');

// Ручной запуск загрузки пар с Binance (временно)
Route::get('/sync-binance', function (BinanceSymbolService $service) {
    $service->fetchAndStoreSymbols();
    return 'Done';
});
