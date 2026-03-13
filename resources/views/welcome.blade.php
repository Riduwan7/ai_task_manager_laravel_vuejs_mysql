<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AI Task Manager') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-[#1a1f2e] text-white min-h-screen flex flex-col selection:bg-blue-500 selection:text-white" style="font-family: 'Inter', sans-serif;">
    
    <!-- Navigation Area -->
    <header class="w-full px-6 py-4 flex justify-between items-center bg-[#242b3d] shadow-md border-b border-gray-800">
        <div class="flex items-center gap-2">
            <!-- Brand Logo Mark -->
            <div class="w-8 h-8 rounded-lg bg-blue-500 flex items-center justify-center text-white font-bold text-xl">
                AI
            </div>
            <span class="text-xl font-bold tracking-wide">Task Manager</span>
        </div>

        @if (Route::has('login'))
            <nav class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors py-2">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors py-2">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-medium bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg transition-colors">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col items-center justify-center p-6 text-center relative overflow-hidden">
        
        <!-- Background decorative elements to match the dark aesthetic -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl rounded-full pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl mx-auto space-y-8">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-white mb-6">
                Manage your tasks with <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">AI Intelligence</span>
            </h1>
            
            <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Streamline your workflow with smart summaries, intuitive tracking, and a beautiful dark interface designed for focus.
            </p>

            <div class="pt-8 flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl text-lg transition-all transform hover:-translate-y-1 shadow-[0_0_20px_rgba(37,99,235,0.3)]">
                        Open Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl text-lg transition-all transform hover:-translate-y-1 shadow-[0_0_20px_rgba(37,99,235,0.3)]">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-[#242b3d] hover:bg-[#2d3748] text-gray-300 hover:text-white font-medium rounded-xl text-lg transition-all border border-gray-700">
                        Sign In
                    </a>
                @endauth
            </div>
            
            <!-- Small preview image mockup container -->
            <div class="mt-16 relative mx-auto w-full max-w-4xl rounded-xl shadow-2xl overflow-hidden border border-gray-800 bg-[#242b3d]">
                <!-- fake browser header -->
                <div class="h-8 bg-[#1a1f2e] border-b border-gray-800 flex items-center px-4 gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                <!-- Mockup inner -->
                <div class="p-8 pb-0">
                    <div class="flex gap-4 mb-6">
                        <div class="w-1/4 h-32 rounded-xl bg-[#1f2433] border border-gray-700 p-4">
                            <div class="w-8 h-8 rounded-full bg-blue-500/20 mb-3"></div>
                            <div class="h-4 w-1/2 bg-gray-700 rounded mb-2"></div>
                            <div class="h-8 w-1/3 bg-gray-600 rounded"></div>
                        </div>
                        <div class="w-1/4 h-32 rounded-xl bg-[#1f2433] border border-gray-700 p-4">
                            <div class="w-8 h-8 rounded-full bg-green-500/20 mb-3"></div>
                            <div class="h-4 w-1/2 bg-gray-700 rounded mb-2"></div>
                            <div class="h-8 w-1/3 bg-gray-600 rounded"></div>
                        </div>
                        <div class="w-1/4 h-32 rounded-xl bg-[#1f2433] border border-gray-700 p-4">
                            <div class="w-8 h-8 rounded-full bg-yellow-500/20 mb-3"></div>
                            <div class="h-4 w-1/2 bg-gray-700 rounded mb-2"></div>
                            <div class="h-8 w-1/3 bg-gray-600 rounded"></div>
                        </div>
                        <div class="w-1/4 h-32 rounded-xl bg-[#1f2433] border border-gray-700 p-4">
                            <div class="w-8 h-8 rounded-full bg-red-500/20 mb-3"></div>
                            <div class="h-4 w-1/2 bg-gray-700 rounded mb-2"></div>
                            <div class="h-8 w-1/3 bg-gray-600 rounded"></div>
                        </div>
                    </div>
                </div>
                
                <!-- gradient fade to hide the bottom of the mockup -->
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#1a1f2e] to-transparent"></div>
            </div>
        </div>
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm border-t border-gray-800 bg-[#1a1f2e]">
        &copy; {{ date('Y') }} AI Task Manager. Built with Laravel.
    </footer>

</body>
</html>
