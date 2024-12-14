{{-- resources/views/publications/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Публикации') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full border divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Title</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Description</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Edition Year</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Pages Count</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Type</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Category</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Authors</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($publications as $publication)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->title }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->description }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->EditionYear }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->PagesCount }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->category->Type }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $publication->category->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        @foreach($publication->authors as $author)
                                            {{ $author->FullName }}@if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        <a href="{{ route('publications.show', $publication->id) }}" class="text-blue-600 hover:text-blue-800">Просмотр</a> |
                                        <a href="{{ route('publications.edit', $publication->id) }}" class="text-green-600 hover:text-green-800">Редактировать</a> |
                                        <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="inline">
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
