{{-- resources/views/spheres/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Spheres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('spheres.create') }}" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block">+ Add New Sphere</a>
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spheres as $sphere)
                                <tr>
                                    <td class="border px-4 py-2">{{ $sphere->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('spheres.show', $sphere->id) }}" class="text-blue-600 hover:text-blue-800">View</a> |
                                        <a href="{{ route('spheres.edit', $sphere->id) }}" class="text-green-600 hover:text-green-800">Edit</a> |
                                        <form action="{{ route('spheres.destroy', $sphere->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
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
