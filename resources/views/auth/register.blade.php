<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white tracking-wide">Create an account</h2>
        <p class="text-gray-400 text-sm mt-1">Join to start managing tasks with AI.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block text-gray-300 font-medium mb-2 text-sm">Full Name</label>
            <div class="relative">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                    placeholder="John Doe"
                    class="w-full bg-[#1a1f2e] border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-inner transition-colors placeholder-gray-500">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-gray-300 font-medium mb-2 text-sm">Email Address</label>
            <div class="relative">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                    placeholder="you@example.com"
                    class="w-full bg-[#1a1f2e] border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-inner transition-colors placeholder-gray-500">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-gray-300 font-medium mb-2 text-sm">Password</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                    placeholder="••••••••"
                    class="w-full bg-[#1a1f2e] border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-inner transition-colors placeholder-gray-500">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-8">
            <label for="password_confirmation" class="block text-gray-300 font-medium mb-2 text-sm">Confirm Password</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                    placeholder="••••••••"
                    class="w-full bg-[#1a1f2e] border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-inner transition-colors placeholder-gray-500">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-sm" />
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-[#242b3d]">
                Register
            </button>
        </div>
        
        <div class="mt-8 text-center text-sm text-gray-400 border-t border-gray-700/50 pt-6">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-white hover:text-blue-400 font-medium transition-colors">
                Sign In
            </a>
        </div>
    </form>
</x-guest-layout>
