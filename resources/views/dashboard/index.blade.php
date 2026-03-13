<x-app-layout>
    <!-- Custom wrapper matching the dark UI -->
    <div class="min-h-screen bg-[#242b3d] text-white p-6 md:p-10" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-8">
            
            <!-- Left Content Area (Dashboard Main) -->
            <div class="flex-1">
                
                <!-- Header section -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-white tracking-wide">Dashboard</h1>
                    <a href="{{ route('tasks.create') }}" class="bg-[#3b82f6] hover:bg-blue-600 text-white font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        New Task
                    </a>
                </div>

                <!-- Dashboard Content Area mimicking the visual style -->
                <!-- Four Statistics Cards using the styled theme -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col hover:-translate-y-1 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <!-- small dots -->
                            <div class="text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1 uppercase tracking-wider">Total Tasks</h2>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_tasks'] }}</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col hover:-translate-y-1 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1 uppercase tracking-wider">Completed</h2>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['completed_tasks'] }}</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col hover:-translate-y-1 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1 uppercase tracking-wider">Pending</h2>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_tasks'] }}</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col hover:-translate-y-1 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1 uppercase tracking-wider">High Priority</h2>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['high_priority_tasks'] }}</p>
                    </div>

                </div>

                <!-- Main Charts taking place of the gray box in the middle -->
                <div class="bg-gray-50 rounded-2xl p-8 mb-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-white shadow rounded-xl p-6 border border-gray-200">
                            <h2 class="text-gray-900 font-bold mb-6 text-lg">Task Status Overview</h2>
                            <div class="w-full max-w-[250px] mx-auto aspect-square">
                                <canvas id="statusChartReal"></canvas>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded-xl p-6 border border-gray-200">
                            <h2 class="text-gray-900 font-bold mb-6 text-lg">Priority Overview</h2>
                            <div class="w-full h-[250px]">
                                <canvas id="priorityChartReal"></canvas>
                            </div>
                        </div>
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
                        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white font-medium px-6 py-3 border-l-4 border-blue-700 flex justify-between items-center">
                            Dashboard
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </a>
                        <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:bg-gray-50 font-medium px-6 py-3 border-l-4 border-transparent hover:border-gray-300 transition-colors">Tasks</a>
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
            const stats = @json($stats);

            // Left side dynamic charts
            const statusChartReal = new Chart(document.getElementById('statusChartReal'), {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending'],
                    datasets: [{
                        data: [stats.completed_tasks, stats.pending_tasks],
                        backgroundColor: ['#22c55e', '#3b82f6'],
                        borderWidth: 0,
                    }]
                },
                options: { cutout: '75%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { family: "'Inter', sans-serif" } } } } }
            });

            const priorityChartReal = new Chart(document.getElementById('priorityChartReal'), {
                type: 'bar',
                data: {
                    labels: ['High', 'Other'],
                    datasets: [{
                        label: 'Priority',
                        data: [stats.high_priority_tasks, stats.total_tasks - stats.high_priority_tasks],
                        backgroundColor: ['#ef4444', '#cbd5e1'],
                        borderRadius: 6,
                        barThickness: 40,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false, drawBorder: false }, ticks: { font: { family: "'Inter', sans-serif" } } },
                        y: { border: { display: false }, grid: { color: '#f1f5f9' }, ticks: { precision: 0 } }
                    }
                }
            });

            // Sidebar mockup chart
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            let gradient = ctx.createLinearGradient(0, 0, 0, 150);
            gradient.addColorStop(0, '#3b82f6');
            gradient.addColorStop(1, '#2563eb');

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
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { backgroundColor: '#0f172a', titleColor: '#fff', bodyColor: '#cbd5e1', displayColors: false } },
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