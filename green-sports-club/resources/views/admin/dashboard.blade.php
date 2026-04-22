<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Total Students</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalStudents }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Total Coaches</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalCoaches }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <p class="text-gray-500 text-sm">Total Sports</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $totalSports }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                    <p class="text-gray-500 text-sm">Pending Payments</p>
                    <p class="text-3xl font-bold text-red-600">{{ $pendingPayments }}</p>
                </div>
            </div>

            <!-- Welcome -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Welcome, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-gray-500">You are logged in as <span class="font-bold text-green-600">Admin</span>. Use the navigation to manage the club.</p>
            </div>

        </div>
    </div>
</x-app-layout>