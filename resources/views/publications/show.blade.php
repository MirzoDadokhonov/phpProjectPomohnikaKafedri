{{-- resources/views/publications/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publication Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">{{ $publication->title }}</h3>
                    <p class="text-gray-600">{{ $publication->description }}</p>
                    <p><strong>Edition Year:</strong> {{ $publication->EditionYear }}</p>
                    <p><strong>Pages Count:</strong> {{ $publication->PagesCount }}</p>
                    <p><strong>Category:</strong> {{ $publication->category->name }} ({{ $publication->category->Type }})</p>
                    <p><strong>Authors:</strong> 
                        @foreach($publication->authors as $author)
                            {{ $author->FullName }}@if (!$loop->last), @endif
                        @endforeach
                    </p>

                    <a href="{{ route('publications.edit', $publication->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
