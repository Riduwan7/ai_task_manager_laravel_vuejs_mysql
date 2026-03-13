<x-app-layout>
    <!-- Custom wrapper matching the dark UI exactly like the Task List page -->
    <div class="min-h-screen bg-[#242b3d] text-white p-6 md:p-10" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-8">
            
            <!-- Left Content Area (Task Details) -->
            <div class="flex-1">
                
                <!-- Header section -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-white tracking-wide">Task Detail + AI Summary</h1>
                    <a href="{{ route('tasks.create') }}" class="bg-[#3b82f6] hover:bg-blue-600 text-white font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        New Task
                    </a>
                </div>

                <!-- Filters section placeholder (inactive but present in mockup) -->
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

                <!-- Task Details Card -->
                <div class="bg-white rounded-2xl p-8 shadow-sm relative">
                    <!-- Dots menu -->
                    <div class="absolute top-6 right-8 text-gray-400 cursor-pointer hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <h2 class="text-gray-900 text-3xl font-bold mb-4 pr-10">{{ $task->title }}</h2>

                    @php
                        $priority = strtolower($task->priority?->value ?? $task->priority);
                        $status = strtolower($task->status?->value ?? $task->status);
                    @endphp

                    <!-- Badges -->
                    <div class="flex items-center gap-6 mb-8">
                        <div class="flex items-center gap-2">
                            <span class="bg-gray-100 text-gray-600 text-sm px-4 py-1.5 rounded-full font-medium">Status</span>
                            <span class="text-gray-500 font-medium">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="bg-gray-100 text-gray-600 text-sm px-4 py-1.5 rounded-full font-medium">Priority</span>
                            <span class="text-gray-500 font-medium">{{ ucfirst($priority) }}</span>
                        </div>
                    </div>

                    <!-- Inner gray box -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-gray-900 font-bold text-lg mb-4">Description</h3>
                        
                        <p class="text-gray-600 font-medium mb-2">Assigned to: {{ $task->user?->name ?? 'Unassigned' }}</p>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-3 flex justify-between items-center mb-6 max-w-md">
                            <span class="text-gray-600">Due Date: {{ $task->due_date ?? 'No Due Date' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <p class="text-gray-600 mb-8 leading-relaxed">
                            {{ $task->description }}
                        </p>

                        <!-- AI Generated Summary Block -->
                        <div class="bg-white border border-gray-100 rounded-xl p-5 mb-4 shadow-sm">
                            <h4 class="text-gray-900 font-bold mb-3">AI-Generated Summary</h4>
                            <p class="text-gray-600 leading-relaxed text-sm">
                                {{ $task->ai_summary ?? 'No AI summary generated yet. The background job might still be processing, or you can request one manually.' }}
                            </p>
                        </div>

                        <!-- Short AI summary block -->
                        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                            <p class="text-gray-600 text-sm">
                                <span class="font-bold text-gray-900">AI Summary:</span> {{ Str::limit($task->ai_summary ?? 'Not available.', 80) }} <span class="font-bold text-gray-900 ml-2">Priority:</span> {{ ucfirst($task->ai_priority ?? 'Unknown') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 text-center flex justify-center pb-4">
                        <a href="{{ route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-8 py-2.5 rounded-full text-lg shadow-md transition duration-200">
                            Back to Tasks
                        </a>
                    </div>
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

                <!-- Refresh AI Button -->
                <a href="{{ route('tasks.ai.summary', $task->id) }}" class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center text-blue-600 font-bold hover:bg-gray-50 transition cursor-pointer">
                    Refresh AI Summary
                    <div class="p-1 border-2 border-blue-200 rounded text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </a>

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

    <!-- Chart.js and UI fixes -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup simple bar chart mimicking the screenshot
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