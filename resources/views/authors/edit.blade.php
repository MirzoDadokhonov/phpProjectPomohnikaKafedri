{{-- resources/views/authors/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактирование информации об авторе') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Фото')"/>
                            <input type="file" id="image" name="image" required/>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="FullName" :value="__('ФИО')" />
                            <x-text-input id="FullName" class="block mt-1 w-full" type="text" name="FullName" :value="$author->FullName" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="Email" :value="__('Email')" />
                            <x-text-input id="Email" class="block mt-1 w-full" type="email" name="Email" :value="$author->Email" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="ORCID" :value="__('ORCID')" />
                            <x-text-input id="ORCID" class="block mt-1 w-full" type="text" name="ORCID" :value="$author->ORCID" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="Role" :value="__('Должность')" />
                            <x-text-input id="Role" class="block mt-1 w-full" type="text" name="Role" :value="$author->Role" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Изменить') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
