<x-app-layout>
    <!-- Hide the default navigation if it exists in app-layout for this specific page, or we can just override it by placing our content with absolute positioning or a negative margin. Since we want a full custom dashboard feel, let's use a full screen wrapper. -->
    
    <div class="min-h-screen bg-[#242b3d] text-white p-6 md:p-10" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-8">
            
            <!-- Left Content Area (Tasks List) -->
            <div class="flex-1">
                
                <!-- Header section -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-white tracking-wide">Task List</h1>
                    <a href="{{ route('tasks.create') }}" class="bg-[#3b82f6] hover:bg-blue-600 text-white font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        New Task
                    </a>
                </div>

                <!-- Filters section -->
                <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-4 mb-8">
                    <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Search Filter Task" class="w-full pl-10 pr-3 py-2.5 bg-white text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-none">
                    </div>

                    <select name="status" onchange="this.form.submit()" class="bg-white text-gray-600 font-medium py-2.5 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-none cursor-pointer">
                        <option value="">Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <select name="assigned_to" onchange="this.form.submit()" class="bg-white text-gray-600 font-medium py-2.5 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-none cursor-pointer">
                        <option value="">All Users</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('assigned_to') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                        @endforeach
                    </select>

                    <select name="priority" onchange="this.form.submit()" class="bg-white text-gray-600 font-medium py-2.5 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-none cursor-pointer">
                        <option value="">Priority</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>

                    <a href="{{ route('tasks.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2.5 px-6 rounded-lg shadow-sm transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear
                    </a>
                </form>

                <!-- Filter Subtitle placeholder to match image -->
                <p class="text-gray-400 text-sm mb-4">Filter Aser Task</p>

                <!-- Tasks Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                    @forelse($tasks as $task)
                        @php
                            $priority = strtolower($task->priority?->value ?? $task->priority);
                            $status = strtolower($task->status?->value ?? $task->status);
                        @endphp
                        
                        <div class="bg-white rounded-2xl p-6 shadow-sm flex flex-col justify-between h-auto min-h-[220px]">
                            <!-- Header (Status indicator & Menu) -->
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </span>
                                </div>
                                <div class="text-gray-400 cursor-pointer hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-gray-900 text-lg font-bold mb-3 line-clamp-2 leading-tight">
                                {{ $task->title }}
                            </h3>

                            <!-- Badges -->
                            <div class="flex items-center gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1.5 rounded-md font-medium">Status</span>
                                <span class="text-xs px-3 py-1.5 rounded-md font-medium text-white {{ $priority == 'high' ? 'bg-red-500' : ($priority == 'medium' ? 'bg-yellow-500' : 'bg-green-500') }}">
                                    Priority {{ ucfirst($priority) }}
                                </span>
                            </div>
                            
                            <!-- Description (Only show when there is AI summary or description to mimic image varying card heights) -->
                            @if($loop->first && $task->description)
                                <div class="bg-gray-50 p-3 rounded-lg text-sm text-gray-600 mb-4 line-clamp-3">
                                    Description: {{ Str::limit($task->description, 60) }}<br>
                                    AI Priority: {{ ucfirst($task->ai_priority ?? 'Medium') }}
                                </div>
                            @endif

                            <!-- Meta info and Actions -->
                            <div class="mt-auto pt-4 flex items-end justify-between border-t border-gray-100">
                                <div class="text-gray-400 text-sm space-y-1 w-1/2">
                                    @if($task->user)
                                        <p class="truncate text-gray-500 font-medium">Assigned: <span class="text-gray-600">{{ $task->user->name }}</span></p>
                                    @endif
                                    @if($task->due_date)
                                        <p>Due: {{ $task->due_date }}</p>
                                    @endif
                                    <p class="text-blue-500 font-semibold mt-2 text-sm">{{ ucfirst($priority) }}</p>
                                </div>

                                <div class="flex gap-2 flex-wrap justify-end">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-4 py-1.5 rounded-full text-sm transition transition-colors">
                                        Edit
                                    </a>
                                    <a href="{{ route('tasks.show', $task->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-1.5 rounded-full text-sm transition transition-colors shadow-sm shadow-blue-500/30">
                                        View
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-[#fef2f2] hover:bg-red-100 text-red-600 font-medium px-4 py-1.5 rounded-full text-sm transition-colors border border-red-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-10 bg-[#2b3040] rounded-xl text-gray-400 border border-gray-700 border-dashed">
                            No tasks found
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
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
                        <a href="{{ route('tasks.index') }}" class="bg-blue-500 text-white font-medium px-6 py-3 border-l-4 border-blue-700">Tasks</a>
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:bg-gray-50 font-medium px-6 py-3 border-l-4 border-transparent hover:border-gray-300">Dashboard</a>
                        @if(auth()->user()->is_admin)
                        <a href="#" class="text-gray-400 hover:bg-gray-50 font-medium px-6 py-3 border-l-4 border-transparent flex gap-2 items-center">
                            Users <span class="text-xs font-normal text-gray-400">(Only visible to Admin)</span>
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-600 hover:bg-gray-50 font-medium px-6 py-3 border-l-4 border-transparent hover:border-gray-300">
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
                <div class="bg-[#1f2433] rounded-2xl shadow-lg p-6 pb-2 min-h-[200px] flex flex-col border border-gray-700">
                    <h3 class="text-white font-semibold text-[15px] mb-6">Monthly Task Completion</h3>
                    <div class="flex-1 w-full relative h-[120px] mt-auto">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Chart.js for Sidebar -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup simple bar chart mimicking the screenshot
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            
            // Create gradient
            let gradient = ctx.createLinearGradient(0, 0, 0, 150);
            gradient.addColorStop(0, '#3b82f6'); // blue-500
            gradient.addColorStop(1, '#2563eb'); // blue-600

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Tasks',
                        data: [8, 16, 5, 14, 12], // Dummy data matching the curve
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
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleColor: '#fff',
                            bodyColor: '#cbd5e1',
                            padding: 10,
                            displayColors: false,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#94a3b8', font: { size: 11, family: "'Inter', sans-serif" } } // slate-400
                        },
                        y: {
                            grid: { display: false, drawBorder: false },
                            ticks: { 
                                color: '#94a3b8',
                                font: { size: 11 },
                                stepSize: 5,
                                max: 20
                            },
                        }
                    }
                }
            });
            
            // Note: Since we want a full custom page without the standard gray navigation bar from Laravel Breeze interfering,
            // we can remove or hide the navigation for this specific view if needed.
            // A simple JS fix if x-app-layout keeps the top bar:
            const defaultNav = document.querySelector('nav.bg-white.border-b');
            if(defaultNav) defaultNav.style.display = 'none';
            const pageHeader = document.querySelector('header.bg-white.shadow');
            if(pageHeader) pageHeader.style.display = 'none';
            const bodyWrapper = document.querySelector('.min-h-screen.bg-gray-100');
            if(bodyWrapper) bodyWrapper.classList.remove('bg-gray-100');
        });
    </script>

    <style>
        /* Hide pagination default styles to match dark theme better */
        nav[role="navigation"] p { color: #fff; }
        nav[role="navigation"] a { color: #ddd; }
    </style>
</x-app-layout>