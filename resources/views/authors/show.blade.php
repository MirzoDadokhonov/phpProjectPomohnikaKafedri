{{-- resources/views/authors/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Информация об авторе') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">{{ $author->FullName }}</h3>
                    <p><strong>Email:</strong> {{ $author->Email }}</p>
                    <p><strong>ORCID:</strong> {{ $author->ORCID }}</p>
                    <p><strong>Должность:</strong> {{ $author->Role }}</p>
                    
                    <a href="{{ route('authors.edit', $author->id) }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
