<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white tracking-wide">Welcome back</h2>
        <p class="text-gray-400 text-sm mt-1">Sign in to manage your AI tasks.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-400 font-medium" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-gray-300 font-medium mb-2 text-sm">Email Address</label>
            <div class="relative">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    placeholder="you@example.com"
                    class="w-full bg-[#1a1f2e] border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-inner transition-colors placeholder-gray-500">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-gray-300 font-medium text-sm">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    placeholder="••••••••"
                    class="w-full bg-[#1a1f2e] border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-inner transition-colors placeholder-gray-500">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-8">
            <label for="remember_me" class="flex items-center cursor-pointer group">
                <div class="relative flex items-center justify-center w-5 h-5 mr-3">
                    <input id="remember_me" type="checkbox" class="peer sr-only" name="remember">
                    <div class="w-5 h-5 bg-[#1a1f2e] border border-gray-600 rounded peer-checked:bg-blue-600 peer-checked:border-blue-500 peer-focus:ring-2 peer-focus:ring-blue-500 transition-colors"></div>
                    <svg class="absolute w-3 h-3 text-white opacity-0 peer-checked:opacity-100 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Remember me</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-[#242b3d]">
                Sign In
            </button>
        </div>
        
        <div class="mt-8 text-center text-sm text-gray-400 border-t border-gray-700/50 pt-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-white hover:text-blue-400 font-medium transition-colors">
                Create an account
            </a>
        </div>
    </form>
</x-guest-layout>
