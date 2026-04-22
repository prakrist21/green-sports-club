<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Attendance Records
            </h2>
            <a href="{{ route('admin.attendances.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                + Mark Attendance
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
                            <th class="px-6 py-3 text-gray-600">Student</th>
                            <th class="px-6 py-3 text-gray-600">Sport</th>
                            <th class="px-6 py-3 text-gray-600">Coach</th>
                            <th class="px-6 py-3 text-gray-600">Date</th>
                            <th class="px-6 py-3 text-gray-600">Status</th>
                            <th class="px-6 py-3 text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $attendance->student->user->name }}</td>
                                <td class="px-6 py-4">{{ $attendance->sport->name }}</td>
                                <td class="px-6 py-4">{{ $attendance->coach->user->name }}</td>
                                <td class="px-6 py-4">{{ $attendance->date }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs
                                        {{ $attendance->status === 'present' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $attendance->status === 'absent' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $attendance->status === 'late' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.attendances.destroy', $attendance) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-400">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>