{{-- resources/views/publications/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить новую публикацию') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('publications.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Название')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Описание')" />
                            <textarea id="description" class="block mt-1 w-full" name="description"></textarea>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="EditionYear" :value="__('Год выпуска')" />
                            <x-text-input id="EditionYear" class="block mt-1 w-full" type="number" name="EditionYear" min="1980" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Категория')" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->Name }} ({{ $category->Type }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="authors" :value="__('Авторы')" />
                            <select id="authors" name="authors" class="block mt-1 w-full" multiple required>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->FullName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Поля для научных и методических публикаций аналогичны -->

                        <x-primary-button class="mt-4">
                            {{ __('Добавить публикацию') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
