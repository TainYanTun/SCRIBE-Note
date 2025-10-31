<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-[#191919]">
            <!-- Left Side - Hero Section -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-gray-900 via-blue-800/30 to-purple-900/20 p-12 flex-col justify-between relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 left-0 w-full h-full opacity-30">
                    <div class="absolute top-20 left-20 w-72 h-72 bg-blue-600/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-20 right-20 w-96 h-96 bg-blue-700/20 rounded-full blur-3xl"></div>
                </div>

                <!-- Content -->
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('lighticon.svg') }}" alt="App Icon" class="w-10 h-10">
                        </div>
                        <h1 class="text-2xl font-bold text-gray-100">{{ config('app.name', 'NotesApp') }}</h1>
                    </div>
                </div>

                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-gray-100 mb-6 leading-tight">
                        Your thoughts,<br />
                        organized beautifully
                    </h2>
                    <p class="text-lg text-gray-400 mb-8 leading-relaxed max-w-md">
                        Capture ideas, link your thinking, and build your personal knowledge base. Simple, powerful, and designed for clarity.
                    </p>
                    
                    <!-- Features -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-200">Connected Notes</h3>
                                <p class="text-xs text-gray-500">Link your ideas together</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-200">Smart Tags</h3>
                                <p class="text-xs text-gray-500">Organize with custom tags</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-pink-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-200">Visual Graph</h3>
                                <p class="text-xs text-gray-500">See your knowledge map</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer quote -->
                <div class="relative z-10">
                    <p class="text-sm text-gray-600 italic">
                        "The best way to organize your thoughts is to write them down."
                    </p>
                </div>
            </div>

            <!-- Right Side - Auth Forms -->
            <div class="flex-1 flex flex-col justify-center items-center p-6 lg:p-12">
                <!-- Mobile Logo -->
                <div class="lg:hidden mb-8 text-center">
                    <div class="inline-flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-100">{{ config('app.name', 'NotesApp') }}</h1>
                    </div>
                </div>

                <!-- Auth Card -->
                <div class="w-full max-w-md">
                    <!-- Welcome Text -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-100 mb-2">Welcome back</h2>
                        <p class="text-sm text-gray-500">Sign in to continue to your notes</p>
                    </div>

                    <div class="bg-[#252525] border border-gray-800/50 rounded-xl p-8 shadow-xl">
                        <!-- Tabs -->
                        <div class="mb-6">
                            <div class="flex gap-2 p-1 bg-[#1a1a1a] rounded-lg" role="tablist">
                                <button 
                                    class="flex-1 px-4 py-2 text-sm font-medium rounded-md transition-all" 
                                    id="login-tab" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="login" 
                                    aria-selected="true"
                                >
                                    Login
                                </button>
                                <button 
                                    class="flex-1 px-4 py-2 text-sm font-medium rounded-md transition-all" 
                                    id="register-tab" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="register" 
                                    aria-selected="false"
                                >
                                    Register
                                </button>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div id="myTabContent">
                            <!-- Login Tab -->
                            <div class="hidden" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                                    @csrf

                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" class="text-gray-400 text-sm mb-2 font-medium" />
                                        <x-text-input 
                                            id="email" 
                                            class="block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5" 
                                            type="email" 
                                            name="email" 
                                            :value="old('email')" 
                                            placeholder="you@example.com"
                                            required 
                                            autofocus 
                                            autocomplete="username" 
                                        />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <x-input-label for="password" :value="__('Password')" class="text-gray-400 text-sm mb-2 font-medium" />
                                        <x-text-input 
                                            id="password" 
                                            class="block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5"
                                            type="password"
                                            name="password"
                                            placeholder="Enter your password"
                                            required 
                                            autocomplete="current-password" 
                                        />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Remember Me & Forgot Password -->
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center">
                                            <input 
                                                id="remember_me" 
                                                type="checkbox" 
                                                class="rounded bg-[#2a2a2a] border-gray-700 text-blue-600 focus:ring-blue-600 focus:ring-offset-0 focus:ring-2" 
                                                name="remember"
                                            >
                                            <span class="ml-2 text-sm text-gray-400">Remember me</span>
                                        </label>
                                        
                                        @if (Route::has('password.request'))
                                            <a class="text-sm text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                                                Forgot password?
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Submit Button -->
                                    <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-2 focus:ring-blue-500 py-3 font-semibold">
                                        {{ __('Sign in') }}
                                    </x-primary-button>
                                </form>
                            </div>

                            <!-- Register Tab -->
                            <div class="hidden" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" class="text-gray-400 text-sm mb-2 font-medium" />
                                        <x-text-input 
                                            id="name" 
                                            class="block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5" 
                                            type="text" 
                                            name="name" 
                                            :value="old('name')" 
                                            placeholder="Your name"
                                            required 
                                            autofocus 
                                            autocomplete="name" 
                                        />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="reg-email" :value="__('Email')" class="text-gray-400 text-sm mb-2 font-medium" />
                                        <x-text-input 
                                            id="reg-email" 
                                            class="block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5" 
                                            type="email" 
                                            name="email" 
                                            :value="old('email')" 
                                            placeholder="you@example.com"
                                            required 
                                            autocomplete="username" 
                                        />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <x-input-label for="reg-password" :value="__('Password')" class="text-gray-400 text-sm mb-2 font-medium" />
                                        <x-text-input 
                                            id="reg-password" 
                                            class="block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5"
                                            type="password"
                                            name="password"
                                            placeholder="Create a password"
                                            required 
                                            autocomplete="new-password" 
                                        />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-400 text-sm mb-2 font-medium" />
                                        <x-text-input 
                                            id="password_confirmation" 
                                            class="block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5"
                                            type="password"
                                            name="password_confirmation" 
                                            placeholder="Confirm your password"
                                            required 
                                            autocomplete="new-password" 
                                        />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <!-- Submit Button -->
                                    <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-2 focus:ring-blue-500 py-3 font-semibold">
                                        {{ __('Create account') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Text -->
                    <p class="text-center text-xs text-gray-600 mt-6">
                        By continuing, you agree to our Terms of Service and Privacy Policy
                    </p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loginTab = document.getElementById('login-tab');
                const registerTab = document.getElementById('register-tab');
                const loginPanel = document.getElementById('login');
                const registerPanel = document.getElementById('register');

                function switchTab(activeTab, activePanel, inactiveTab, inactivePanel) {
                    activeTab.classList.add('bg-[#252525]', 'text-gray-100');
                    activeTab.classList.remove('text-gray-500');
                    activeTab.setAttribute('aria-selected', 'true');
                    activePanel.classList.remove('hidden');

                    inactiveTab.classList.remove('bg-[#252525]', 'text-gray-100');
                    inactiveTab.classList.add('text-gray-500');
                    inactiveTab.setAttribute('aria-selected', 'false');
                    inactivePanel.classList.add('hidden');
                }

                loginTab.addEventListener('click', () => {
                    switchTab(loginTab, loginPanel, registerTab, registerPanel);
                });

                registerTab.addEventListener('click', () => {
                    switchTab(registerTab, registerPanel, loginTab, loginPanel);
                });

                // Show login tab by default
                switchTab(loginTab, loginPanel, registerTab, registerPanel);
            });
        </script>
    </body>
</html>