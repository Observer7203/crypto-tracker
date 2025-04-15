<?php

namespace App\Http\Controllers;

use App\Models\CryptoPair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\AvailablePair;


class CryptoPairController extends Controller
{
    public function index()
    {
        $pairs = CryptoPair::all();
        return view('pairs.index', compact('pairs'));
    }

    public function create()
    {
        $baseCurrencies = AvailablePair::select('base_asset')->distinct()->orderBy('base_asset')->pluck('base_asset');
        $quoteCurrencies = AvailablePair::select('quote_asset')->distinct()->orderBy('quote_asset')->pluck('quote_asset');
    
        return view('pairs.create', compact('baseCurrencies', 'quoteCurrencies'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'base_currency' => 'required|string',
            'quote_currency' => 'required|string',
            'update_interval' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        CryptoPair::create([
            'base_currency' => $request->base_currency,
            'quote_currency' => $request->quote_currency,
            'update_interval' => $request->update_interval,
            'is_active' => $request->has('is_active'),
        ]);

        Log::info('Сохранение пары', $request->all());

        return redirect()->route('pairs.index')->with('success', 'Пара добавлена');
    }

    public function edit(CryptoPair $pair)
    {
        $baseCurrencies = AvailablePair::select('base_asset')->distinct()->orderBy('base_asset')->pluck('base_asset');
        $quoteCurrencies = AvailablePair::select('quote_asset')->distinct()->orderBy('quote_asset')->pluck('quote_asset');
    
        return view('pairs.edit', compact('pair', 'baseCurrencies', 'quoteCurrencies'));
    }
    
    public function update(Request $request, CryptoPair $pair)
    {
        $request->validate([
            'base_currency' => 'required|string|size:3',
            'quote_currency' => 'required|string|size:3',
            'update_interval' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $pair->update([
            'base_currency' => $request->base_currency,
            'quote_currency' => $request->quote_currency,
            'update_interval' => $request->update_interval,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('pairs.index')->with('success', 'Пара обновлена');
    }

    public function destroy(CryptoPair $pair)
    {
        $pair->delete();
        return redirect()->route('pairs.index')->with('success', 'Пара удалена');
    }
}
