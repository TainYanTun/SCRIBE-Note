<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Search Notes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('notes.search') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <x-text-input 
                            id="search" 
                            class="block w-full pl-11 pr-4 py-3 bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-500 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors" 
                            type="text" 
                            name="search" 
                            placeholder="Search notes..." 
                            value="{{ $search }}" 
                        />
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <div class="space-y-2">
                @forelse ($notes as $note)
                    <div class="group bg-[#252525] hover:bg-[#2c2c2c] rounded-lg transition-colors duration-150 border border-transparent hover:border-gray-800">
                        <a href="{{ route('notes.show', $note) }}" class="block p-5">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-medium text-gray-100 group-hover:text-white mb-1.5">
                                        {{ $note->title }}
                                    </h3>
                                    <p class="text-sm text-gray-400 leading-relaxed mb-2">
                                        @php
                                            $lines = explode("\n", $note->content);
                                            $displayContent = implode("\n", array_slice($lines, 0, 1));
                                        @endphp
                                        {!! nl2br(e($displayContent)) !!}@if (count($lines) > 1)...@endif
                                    </p>
                                    <div class="flex items-center text-xs text-gray-600">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $note->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">No notes found for "{{ $search }}".</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>