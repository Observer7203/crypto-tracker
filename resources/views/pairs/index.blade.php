@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-l font-small text-gray-900 mb-4">Список крипто-пар</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full divide-y divide-gray-200 table-list">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Base</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quote</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Интервал</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Активна</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Текущий курс</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($pairs as $pair)
                <tr>
                    <td class="px-4 py-2">{{ $pair->base_currency }}</td>
                    <td class="px-4 py-2">{{ $pair->quote_currency }}</td>
                    <td class="px-4 py-2">{{ $pair->update_interval }} мин.</td>
                    <td class="px-4 py-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pair->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $pair->is_active ? 'Да' : 'Нет' }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $pair->current_price ?? '—' }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('pairs.edit', $pair) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                            <form action="{{ route('pairs.destroy', $pair) }}" method="POST" onsubmit="return confirm('Удалить эту пару?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Удалить</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
.table-list {
    font-size: 13px;
}
</style>
@endsection
