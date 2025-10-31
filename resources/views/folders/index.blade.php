<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $folder ? $folder->name : 'My Files' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <div class="p-6">
                    <!-- Breadcrumb Navigation -->
                    @if($folder)
                        <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">
                            <a href="{{ $folder->parent_id ? route('folders.index', ['folder' => $folder->parent_id]) : route('folders.index') }}" class="hover:text-gray-300 transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back
                            </a>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <a href="{{ route('folders.index') }}" class="hover:text-gray-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </a>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span class="text-gray-300">{{ $folder->name }}</span>
                        </div>
                    @endif

<form action="{{ route('folders.store') }}" method="POST" class="mb-8">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $folder ? $folder->id : '' }}">
                        
                        <div class="flex items-center gap-3">
                            <div class="flex-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="New folder name" 
                                    class="block w-full pl-10 pr-3 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors"
                                    required
                                >
                            </div>
                            <button 
                                type="submit" 
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg font-medium text-sm text-gray-200 transition-colors"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Folder
                            </button>
                        </div>
                    </form>

                    <!-- Folders Section -->
                    <div>
                        @foreach ($folders as $subFolder)
                            <div class="group flex items-center justify-between p-4 mb-2 bg-transparent hover:bg-white/5 rounded-lg transition-all duration-150 border border-transparent hover:border-gray-800">
                                <a 
                                    href="{{ route('folders.index', ['folder' => $subFolder->id]) }}" 
                                    class="flex items-center gap-3 flex-grow"
                                >
                                    <div class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center group-hover:bg-gray-700 transition-colors">
                                        <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors">
                                            {{ $subFolder->name }}
                                        </h4>
                                        <p class="text-xs text-gray-600">
                                            Created {{ $subFolder->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </a>
                                <!-- Folder Actions (Edit/Delete) -->
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-700 text-gray-500 hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-[#2c2c2c] rounded-md shadow-lg z-10 border border-gray-700">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Edit</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-red-400 hover:bg-gray-700">Delete</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($folder)
                        <!-- Notes Section -->
                        <div>
                            @foreach ($notes as $note)
                                <a 
                                    href="{{ route('notes.show', $note) }}" 
                                    class="group flex items-center justify-between p-4 mb-2 bg-transparent hover:bg-white/5 rounded-lg transition-all duration-150 border border-transparent hover:border-gray-800"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center group-hover:bg-gray-700 transition-colors">
                                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors">
                                                {{ $note->title }}
                                            </h4>
                                            <p class="text-xs text-gray-600">
                                                Created {{ $note->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if ($folders->isEmpty() && $notes->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800/50 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm font-medium mb-1">No folders or notes here yet</p>
                            <p class="text-gray-600 text-xs">Create your first folder or note to get organized</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>