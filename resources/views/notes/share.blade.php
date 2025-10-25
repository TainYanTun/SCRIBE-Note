<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Share Note: ' . $note->title) }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <div class="p-8">
                    <!-- Session Messages -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 font-medium text-sm text-red-600 bg-red-100 p-3 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Header -->
                    <div class="mb-6 pb-6 border-b border-gray-800/50">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-100">Share with Others</h3>
                        </div>
                        <p class="text-sm text-gray-500">Invite someone to collaborate on this note</p>
                    </div>

                    <form method="POST" action="{{ route('notes.processShare', $note) }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('User Email')" class="text-gray-400 text-sm font-medium mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <x-text-input 
                                    id="email" 
                                    class="block w-full pl-10 bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    placeholder="user@example.com"
                                    required 
                                    autofocus 
                                />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Permission Level -->
                        <div>
                            <x-input-label for="permission" :value="__('Permission Level')" class="text-gray-400 text-sm font-medium mb-2" />
                            <select 
                                id="permission" 
                                name="permission" 
                                class="block w-full px-3 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-lg shadow-sm transition-colors" 
                                required
                            >
                                <option value="edit">Can Edit, Comment & View</option>
                                <option value="comment">Can Comment & View</option>
                                <option value="view">Can Only View</option>
                            </select>
                            <x-input-error :messages="$errors->get('permission')" class="mt-2" />
                        </div>

                        <!-- Permission Info Cards -->
                        <div class="space-y-2">
                            <div class="bg-[#2a2a2a] border border-gray-800/50 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-200 mb-1">Can Edit, Comment & View</h4>
                                        <p class="text-xs text-gray-500">Full control to modify content, add comments, and view the note.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-[#2a2a2a] border border-gray-800/50 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-200 mb-1">Can Comment & View</h4>
                                        <p class="text-xs text-gray-500">Can add comments and view content, but cannot edit the note.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-[#2a2a2a] border border-gray-800/50 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-200 mb-1">Can Only View</h4>
                                        <p class="text-xs text-gray-500">Read-only access. Cannot make changes or add comments.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Warning Banner -->
                        <div class="bg-amber-600/10 border border-amber-600/30 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <h4 class="text-sm font-semibold text-amber-400 mb-1">Important Security Notice</h4>
                                    <p class="text-xs text-amber-300/90">Sharing with 'Can Edit' permission grants significant control over your note. Ensure you trust the recipient before granting edit access.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-800/50">
                            <a href="{{ route('notes.show', $note) }}" class="text-sm text-gray-500 hover:text-gray-400 transition-colors">
                                Cancel
                            </a>
                            <x-primary-button class="bg-gray-800 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-gray-600 px-6 py-2.5 transition-colors">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                {{ __('Send Invitation') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>