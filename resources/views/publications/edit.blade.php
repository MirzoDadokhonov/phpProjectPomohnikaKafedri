{{-- resources/views/publications/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Publication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('publications.update', $publication->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $publication->title }}" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full" name="description">{{ $publication->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="EditionYear" :value="__('Edition Year')" />
                            <x-input id="EditionYear" class="block mt-1 w-full" type="number" name="EditionYear" value="{{ $publication->EditionYear }}" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $publication->category_id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->Type }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="authors" :value="__('Authors')" />
                            <select id="authors" name="authors[]" class="block mt-1 w-full" multiple required>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ $publication->authors->contains($author->id) ? 'selected' : '' }}>
                                        {{ $author->FullName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Поля для научных и методических публикаций аналогичны -->

                        <x-button class="mt-4">
                            {{ __('Update Publication') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
