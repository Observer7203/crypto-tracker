<?php

namespace App\Http\Controllers;

use App\Models\CryptoRate;
use App\Models\CryptoPair;
use Illuminate\Http\Request;

class CryptoRateController extends Controller
{
    public function index(Request $request)
    {
        $query = CryptoRate::with('pair');

        // Фильтрация по паре
        if ($request->filled('pair_id')) {
            $query->where('crypto_pair_id', $request->pair_id);
        }

        // Фильтрация по периоду
        if ($request->filled('from')) {
            $query->where('timestamp', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('timestamp', '<=', $request->to);
        }

        // Сортировка
        if ($request->filled('sort')) {
            $sortField = in_array($request->sort, ['rate', 'timestamp']) ? $request->sort : 'timestamp';
            $sortDir = $request->get('dir', 'desc') === 'asc' ? 'asc' : 'desc';
            $query->orderBy($sortField, $sortDir);
        } else {
            $query->orderBy('timestamp', 'desc');
        }

        $rates = $query->paginate(20);
        $pairs = CryptoPair::all();
        return view('rates.index', compact('rates', 'pairs'));
    }
}
