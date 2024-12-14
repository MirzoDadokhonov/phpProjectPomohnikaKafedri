{{-- resources/views/categories/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Категории') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('categories.create') }}" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block">+ Добавить новую категорию</a>
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Название</th>
                                <th class="border px-4 py-2">Тип</th>
                                <th class="border px-4 py-2">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="border px-4 py-2">{{ $category->Name }}</td>
                                    <td class="border px-4 py-2">{{ $category->Type }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('categories.show', $category->id) }}" class="text-blue-600 hover:text-blue-800">Просмотр</a> |
                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-green-600 hover:text-green-800">Редактировать</a> |
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Вы уверены?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
