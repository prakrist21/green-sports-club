<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Sports
            </h2>
            <a href="{{ route('admin.sports.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                + Add Sport
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-6 py-3 text-gray-600">#</th>
                            <th class="px-6 py-3 text-gray-600">Name</th>
                            <th class="px-6 py-3 text-gray-600">Description</th>
                            <th class="px-6 py-3 text-gray-600">Students</th>
                            <th class="px-6 py-3 text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sports as $sport)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $sport->name }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $sport->description ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $sport->students->count() }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.sports.edit', $sport) }}" class="text-blue-500 hover:underline mr-3">Edit</a>
                                    <form action="{{ route('admin.sports.destroy', $sport) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">No sports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>