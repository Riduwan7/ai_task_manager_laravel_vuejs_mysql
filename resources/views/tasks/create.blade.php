<x-app-layout>
    <!-- Custom wrapper matching the dark UI -->
    <div class="min-h-screen bg-[#242b3d] text-white p-6 md:p-10" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-8">
            
            <!-- Left Content Area (Task Create Form) -->
            <div class="flex-1 border-none">
                
                <!-- Header section -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-white tracking-wide">Create New Task</h1>
                </div>

                <!-- Filters section placeholder -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <div class="relative w-full md:w-64 opacity-50 cursor-not-allowed">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" disabled placeholder="Search Filter Task" class="w-full pl-10 pr-3 py-2.5 bg-white text-gray-800 rounded-lg border-none">
                    </div>

                    <select disabled class="bg-white text-gray-600 font-medium py-2.5 px-4 rounded-lg opacity-50 cursor-not-allowed border-none">
                        <option>Status</option>
                    </select>

                    <select disabled class="bg-white text-gray-600 font-medium py-2.5 px-4 rounded-lg opacity-50 cursor-not-allowed border-none">
                        <option>All Users</option>
                    </select>

                    <select disabled class="bg-white text-gray-600 font-medium py-2.5 px-4 rounded-lg opacity-50 cursor-not-allowed border-none">
                        <option>Priority</option>
                    </select>
                </div>

                <p class="text-gray-400 text-sm mb-4">Filter Aser Task</p>

                <!-- Create Form Card -->
                <form method="POST" action="{{ route('tasks.store') }}" class="bg-white rounded-2xl p-8 shadow-sm relative">
                    @csrf

                    <!-- Dots menu -->
                    <div class="absolute top-6 right-8 text-gray-400 cursor-pointer hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <h2 class="text-gray-900 text-3xl font-bold mb-8 pr-10">
                        New Task Details
                    </h2>

                    @if ($errors->any())
                        <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 shadow-sm">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Inner gray box mimicking the image styling -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-8 shadow-inner">
                        
                        <!-- Title Input -->
                        <div class="relative mb-6">
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter Task Name" class="w-full bg-white border border-gray-200 text-gray-800 rounded-lg p-3 pr-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-medium shadow-sm transition-shadow">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=EBF4FF&color=4F46E5" class="h-6 w-6 rounded-full border border-gray-100" alt="User">
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div class="bg-white border text-gray-600 border-gray-200 rounded-lg p-4 mb-6 shadow-sm">
                            <textarea name="description" rows="4" placeholder="Task description..." class="w-full bg-transparent border-none p-0 focus:ring-0 resize-none text-sm">{{ old('description') }}</textarea>
                        </div>

                        <!-- Priority Selection -->
                        @php
                            $currentPriority = old('priority', 'medium');
                        @endphp
                        <div class="mb-6 flex flex-wrap items-center gap-4">
                            <label class="text-gray-900 font-bold w-20">Priority</label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="priority" value="low" class="peer sr-only" {{ $currentPriority == 'low' ? 'checked' : '' }}>
                                <div class="px-5 py-2 rounded-lg font-medium text-sm border bg-white text-gray-500 border-gray-200 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 hover:bg-gray-50 transition-colors">
                                    Low
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="priority" value="medium" class="peer sr-only" {{ $currentPriority == 'medium' ? 'checked' : '' }}>
                                <div class="px-5 py-2 rounded-lg font-medium text-sm border bg-white text-gray-500 border-gray-200 peer-checked:bg-yellow-100 peer-checked:text-yellow-700 peer-checked:border-yellow-200 hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    + Medium
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="priority" value="high" class="peer sr-only" {{ $currentPriority == 'high' ? 'checked' : '' }}>
                                <div class="px-5 py-2 rounded-lg font-medium text-sm border bg-white text-gray-500 border-gray-200 peer-checked:bg-red-100 peer-checked:text-red-700 peer-checked:border-red-200 hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    + High
                                </div>
                            </label>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4 text-gray-700">
                            <div class="relative max-w-md">
                                <input type="date" name="due_date" value="{{ old('due_date') }}" class="w-full bg-white border border-gray-200 text-gray-600 rounded-lg p-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-shadow">
                            </div>
                        </div>

                        <!-- Assign To -->
                        <div class="mb-4">
                            <label class="block text-gray-900 font-bold mb-2">Assign To</label>
                            <div class="relative max-w-md">
                                <select name="assigned_to" class="w-full bg-white text-gray-600 border border-gray-200 rounded-lg p-3 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-shadow">
                                    <option value="" disabled selected>Select an assignee</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 text-center pb-4 flex gap-4 justify-center">
                        <a href="{{ route('tasks.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-8 py-2.5 rounded-full text-lg shadow-sm transition duration-200 border border-gray-200">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-8 py-2.5 rounded-full text-lg shadow-md transition duration-200">
                            Create Task
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Sidebar -->
            <div class="w-full lg:w-[320px] flex flex-col gap-6">
                <!-- User Profile & Menu Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col pt-6">
                    <div class="flex items-center gap-4 px-6 mb-6">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=EBF4FF&color=4F46E5" alt="User Avatar" class="w-12 h-12 rounded-full border-2 border-gray-100 object-cover p-0.5">
                        <div class="font-bold text-gray-800 text-lg">{{ auth()->user()->name }}</div>
                    </div>

                    <div class="flex flex-col mb-4">
                        <a href="{{ route('tasks.index') }}" class="bg-blue-500 text-white font-medium px-6 py-3 border-l-4 border-blue-700 flex justify-between items-center">
                            Tasks
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </a>
                        <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:bg-gray-50 font-medium px-6 pl-10 py-3 border-l-4 border-transparent hover:border-gray-300 bg-blue-50">Tasks List</a>
                        @if(auth()->user()->is_admin)
                        <a href="#" class="text-gray-400 hover:bg-gray-50 font-medium px-6 py-3 border-l-4 border-transparent flex gap-2 items-center">
                            Users <span class="text-xs font-normal text-gray-400">(Only visible to Admin)</span>
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-600 hover:bg-gray-50 font-medium px-6 py-3 border-l-4 border-transparent hover:border-gray-300 transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>

                    <div class="border-t border-gray-100 pt-6 px-6 pb-6">
                        <!-- Doughnut Charts -->
                        <div class="flex justify-between items-center px-2">
                            <!-- Total Chart Context -->
                            <div class="relative w-[60px] h-[60px] flex justify-center items-center">
                                <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-blue-100" stroke-width="4"></circle>
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-blue-500" stroke-width="4" stroke-dasharray="100 100" stroke-dashoffset="{{ 100 - ($stats['total_tasks'] > 0 ? 100 : 0) }}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col justify-center items-center">
                                    <span class="text-[9px] text-gray-400 mt-1">Total</span>
                                    <span class="text-xs font-bold text-gray-800 -mt-1">{{ $stats['total_tasks'] }}</span>
                                </div>
                            </div>

                            <!-- Completed -->
                            <div class="relative w-[60px] h-[60px] flex justify-center items-center">
                                <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-green-100" stroke-width="4"></circle>
                                    @php
                                        $compPct = $stats['total_tasks'] > 0 ? round(($stats['completed_tasks'] / $stats['total_tasks']) * 100) : 0;
                                    @endphp
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-green-500" stroke-width="4" stroke-dasharray="100 100" stroke-dashoffset="{{ 100 - $compPct }}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col justify-center items-center">
                                    <span class="text-[9px] text-gray-400 mt-1">Completed</span>
                                    <span class="text-xs font-bold text-gray-800 -mt-1">{{ $stats['completed_tasks'] }}</span>
                                </div>
                            </div>
                            
                            <!-- Pending -->
                            <div class="relative w-[60px] h-[60px] flex justify-center items-center">
                                <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-blue-100" stroke-width="4"></circle>
                                    @php
                                        $pendPct = $stats['total_tasks'] > 0 ? round(($stats['pending_tasks'] / $stats['total_tasks']) * 100) : 0;
                                    @endphp
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-blue-400" stroke-width="4" stroke-dasharray="100 100" stroke-dashoffset="{{ 100 - $pendPct }}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col justify-center items-center">
                                    <span class="text-[9px] text-gray-400 mt-1">Pending</span>
                                    <span class="text-xs font-bold text-gray-800 -mt-1">{{ $stats['pending_tasks'] }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-sm font-medium text-gray-600 mt-3 hover:text-gray-800 cursor-default">Task Completion Details</p>
                    </div>
                </div>

                <!-- Monthly Task Completion Dark Card -->
                <div class="bg-[#1f2433] rounded-2xl shadow-lg p-6 pb-2 min-h-[200px] flex flex-col border border-gray-700 transition hover:border-gray-600">
                    <h3 class="text-white font-semibold text-[15px] mb-6">Monthly Task Completion</h3>
                    <div class="flex-1 w-full relative h-[120px] mt-auto">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Chart.js and UI fixes -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            
            let gradient = ctx.createLinearGradient(0, 0, 0, 150);
            gradient.addColorStop(0, '#3b82f6'); // blue-500
            gradient.addColorStop(1, '#2563eb'); // blue-600

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Tasks',
                        data: [8, 16, 5, 14, 12],
                        backgroundColor: gradient,
                        borderRadius: 4,
                        barThickness: 16,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { backgroundColor: '#0f172a', titleColor: '#fff', bodyColor: '#cbd5e1', padding: 10, displayColors: false }
                    },
                    scales: {
                        x: { grid: { display: false, drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 11, family: "'Inter', sans-serif" } } },
                        y: { grid: { display: false, drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 11 }, stepSize: 5, max: 20 } }
                    }
                }
            });
            
            // Hide standard Breeze UI components
            const defaultNav = document.querySelector('nav.bg-white.border-b');
            if(defaultNav) defaultNav.style.display = 'none';
            const pageHeader = document.querySelector('header.bg-white.shadow');
            if(pageHeader) pageHeader.style.display = 'none';
            const bodyWrapper = document.querySelector('.min-h-screen.bg-gray-100');
            if(bodyWrapper) bodyWrapper.classList.remove('bg-gray-100');
        });
    </script>
</x-app-layout>
