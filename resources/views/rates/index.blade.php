@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-l font-small text-gray-900 mb-4">История курсов</h1>

    <!-- Фильтры -->
    <form method="GET" action="{{ route('rates.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 table-list">
        <div>
            <label class="block text-sm font-medium text-gray-700">Крипто-пара</label>
            <select name="pair_id" class="mt-1 w-full rounded border-gray-300 select select-sm">
                <option value="">Все</option>
                @foreach($pairs as $pair)
                    <option value="{{ $pair->id }}" {{ request('pair_id') == $pair->id ? 'selected' : '' }}>
                        {{ $pair->base_currency }}/{{ $pair->quote_currency }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">С даты</label>
            <input type="date" name="from" value="{{ request('from') }}"
                   class="mt-1 w-full rounded border-gray-300 select select-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">По дату</label>
            <input type="date" name="to" value="{{ request('to') }}"
                   class="mt-1 w-full rounded border-gray-300 select select-sm">
        </div>

        <div class="flex items-end">
            <button type="submit"
                    class="btn btn-light btn-sm font-medium py-2 px-4 rounded w-full">
                Применить фильтр
            </button>
        </div>
    </form>

    <!-- Таблица курсов -->
    <table class="min-w-full divide-y divide-gray-200 table-list">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Крипто-пара</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Курс</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Время</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($rates as $rate)
                <tr>
                    <td class="px-4 py-2">
                        {{ $rate->pair->base_currency }}/{{ $rate->pair->quote_currency }}
                    </td>
                    <td class="px-4 py-2">{{ $rate->rate }}</td>
                    <td class="px-4 py-2">{{ $rate->timestamp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $rates->withQueryString()->links() }}
    </div>
</div>
<style>
.select {
    font-weight: 500;
    font-size: .8125rem;
    line-height: 1;
    background-color: #fcfcfc;
    border-radius: .375rem;
    height: 2.5rem;
    padding-inline-start: .75rem;
    padding-inline-end: .75rem;
    border: 1px solid #dbdfe9;
    color: #4b5675;
}
.select-sm {
    font-weight: 500;
    font-size: .75rem;
    height: 2rem;
    padding-inline-start: .625rem;
    padding-inline-end: .625rem;
    background-size: 14px 10px;
    background-position: inset-inline-end .55rem;
}
.table-list {
    font-size: 13px;
}

.btn-light {
    color: #4b5675;
    border-color: #dbdfe9 !important;
    background-color: #fff;
}

.btn-sm {
    height: 2rem;
    padding-inline-start: .75rem;
    padding-inline-end: .75rem;
    font-weight: 500;
    font-size: .75rem;
    gap: .275rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    line-height: 1;
    border-radius: .375rem;
    height: 2.5rem;
    padding-inline-start: 1rem;
    padding-inline-end: 1rem;
    gap: .375rem;
    border: 1px solid transparent;
    font-weight: 500;
    font-size: .8125rem;
    outline: none;
    height: 2rem;
}

.btn-light.active, .btn-light:active, .btn-light:focus, .btn-light:hover {
    border-color: #dbdfe9;
    background-color: #fcfcfc;
    box-shadow: 0px 4px 12px 0px rgba(0,0,0,.09);
    color: #252f4a;
}
</style>
@endsection

