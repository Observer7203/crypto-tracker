@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-xl mx-auto">
    <h1 class="text-xl font-semibold mb-4">Редактировать крипто-пару</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pairs.update', $pair) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="relative">
            <label class="block font-medium text-sm text-gray-700">Base Currency</label>
            <select name="base_currency" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($baseCurrencies as $base)
                    <option value="{{ $base }}" {{ old('base_currency', $pair->base_currency) == $base ? 'selected' : '' }}>
                        {{ $base }}
                    </option>
                @endforeach
            </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500" style="top: 25px;">
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4" />
        </svg>
    </div>
        </div>

        <div class="relative">
            <label class="block font-medium text-sm text-gray-700">Quote Currency</label>
            <select name="quote_currency" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($quoteCurrencies as $quote)
                    <option value="{{ $quote }}" {{ old('quote_currency', $pair->quote_currency) == $quote ? 'selected' : '' }}>
                        {{ $quote }}
                    </option>
                @endforeach
            </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500" style="top: 25px;">
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4" />
        </svg>
    </div>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Интервал обновления (в минутах)</label>
            <input type="number" name="update_interval" value="{{ old('update_interval', $pair->update_interval) }}"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 input-interval">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $pair->is_active) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label class="ml-2 text-sm text-gray-600">Активна</label>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="btn btn-light btn-sm font-medium py-2 px-4 rounded">
                Сохранить изменения
            </button>
        </div>
    </form>
</div>

<style>
select {
    display: block;
    width: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    box-shadow: none;
    outline: none;
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

.input-interval {
    display: block;
    width: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    box-shadow: none;
    outline: none;
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