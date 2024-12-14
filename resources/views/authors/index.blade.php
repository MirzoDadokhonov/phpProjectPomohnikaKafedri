{{-- resources/views/authors/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Авторы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('authors.create') }}" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block"> + Добавить нового автора</a>
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ФИО</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">ORCID</th>
                                <th class="border px-4 py-2">Должность</th>
                                <th class="border px-4 py-2">Фото</th>
                                <th class="border px-4 py-2">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td class="border px-4 py-2">{{ $author->FullName }}</td>
                                    <td class="border px-4 py-2">{{ $author->Email }}</td>
                                    <td class="border px-4 py-2">{{ $author->ORCID }}</td>
                                    <td class="border px-4 py-2">{{ $author->Role }}</td>
                                    <td class="border px-4 py-2" width="200px" height="200px">
                                        @if ($author->getFirstMediaUrl('authors', 'thumb'))
                                        <img src="{{ $author->getFirstMediaUrl('authors', 'thumb') }}" alt="{{ $author->FullName }}">
                                        @else
                                        <p>Нет изображения</p>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('authors.show', $author->id) }}" class="text-blue-600 hover:text-blue-800">Просмотр</a> |
                                        <a href="{{ route('authors.edit', $author->id) }}" class="text-green-600 hover:text-green-800">Редактировать</a> |
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="inline">
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
