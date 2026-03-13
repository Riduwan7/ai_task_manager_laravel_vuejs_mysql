<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AI Task Manager') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-[#1a1f2e] text-white selection:bg-blue-500 selection:text-white" style="font-family: 'Inter', sans-serif;">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        
        <!-- Decorative Backgrounds -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="z-10 mb-8 max-w-md w-full px-6 flex flex-col items-center">
            <a href="/" class="flex items-center gap-3 mb-8 group">
                <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    AI
                </div>
                <span class="text-3xl font-extrabold tracking-tight">Task Manager</span>
            </a>

            <!-- Content Card -->
            <div class="w-full bg-[#242b3d] shadow-2xl border border-gray-800 rounded-2xl overflow-hidden backdrop-blur-sm p-8 sm:p-10">
                {{ $slot }}
            </div>

            <!-- Footer links or notes -->
            <div class="mt-8 text-center text-sm text-gray-500">
                Secure & encrypted system
            </div>
        </div>
    </div>
</body>
</html>
