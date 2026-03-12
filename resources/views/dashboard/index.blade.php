<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-4 gap-6">

            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-gray-500">Total Tasks</h2>
                <p class="text-2xl font-bold">{{ $stats['total_tasks'] }}</p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-gray-500">Completed Tasks</h2>
                <p class="text-2xl font-bold">{{ $stats['completed_tasks'] }}</p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-gray-500">Pending Tasks</h2>
                <p class="text-2xl font-bold">{{ $stats['pending_tasks'] }}</p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h2 class="text-gray-500">High Priority</h2>
                <p class="text-2xl font-bold">{{ $stats['high_priority_tasks'] }}</p>
            </div>

        </div>

    </div>

</x-app-layout>