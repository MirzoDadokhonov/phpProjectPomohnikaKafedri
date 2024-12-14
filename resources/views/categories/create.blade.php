{{-- resources/views/categories/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="Name" :value="__('Name')" />
                            <x-text-input id="Name" class="block mt-1 w-full" type="text" name="Name" :value="old('Name')" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="Type" :value="__('Type')" />
                            <x-text-input id="Type" class="block mt-1 w-full" type="text" name="Type" :value="old('Type')" required />
                        </div>
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
