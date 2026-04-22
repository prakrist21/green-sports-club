<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Coach Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Assigned Sports</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $sports->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Total Students</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalStudents }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <p class="text-gray-500 text-sm">Recent Attendances</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $recentAttendances->count() }}</p>
                </div>
            </div>

            <!-- Welcome -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 border-l-4 border-blue-500">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Welcome, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-gray-500">You are logged in as <span class="font-bold text-blue-600">Coach</span>.
                @if($coach->specialization)
                    Specialization: <span class="font-bold text-gray-700">{{ $coach->specialization }}</span>
                @endif
                </p>
            </div>

            <!-- Assigned Sports -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Your Assigned Sports</h3>
                @if($sports->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($sports as $sport)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                                <p class="font-semibold text-green-700">{{ $sport->name }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $sport->students->count() }} students</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400">No sports assigned yet.</p>
                @endif
            </div>

            <!-- Recent Attendances -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Attendance Records</h3>
                @if($recentAttendances->count() > 0)
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="pb-2 text-gray-600">Student</th>
                                <th class="pb-2 text-gray-600">Sport</th>
                                <th class="pb-2 text-gray-600">Date</th>
                                <th class="pb-2 text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAttendances as $attendance)
                                <tr class="border-b">
                                    <td class="py-2">{{ $attendance->student->user->name }}</td>
                                    <td class="py-2">{{ $attendance->sport->name }}</td>
                                    <td class="py-2">{{ $attendance->date }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs
                                            {{ $attendance->status === 'present' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $attendance->status === 'absent' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $attendance->status === 'late' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-400">No attendance records yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>