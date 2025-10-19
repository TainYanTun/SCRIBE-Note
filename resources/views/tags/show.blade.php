<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Tag Details') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Tag Details Container -->
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <!-- Header Actions -->
                <div class="flex items-center justify-between px-8 pt-6 pb-4 border-b border-gray-800/30">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('tags.index') }}" class="text-gray-500 hover:text-gray-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $tag->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ route('tags.edit', $tag) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-800/50 hover:bg-gray-800 border border-gray-700/50 rounded-md text-xs text-gray-400 hover:text-gray-200 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600/10 hover:bg-red-600/20 border border-red-600/30 rounded-md text-xs text-red-400 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tag Info -->
                <div class="px-8 pt-8 pb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-purple-600/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-100">{{ $tag->name }}</h1>
                            <p class="text-sm text-gray-600 mt-1">{{ $tag->slug }}</p>
                        </div>
                    </div>
                    
                    <!-- Metadata Row -->
                    <div class="flex items-center gap-4 text-xs text-gray-600">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Created {{ $tag->created_at->format('M d, Y') }}</span>
                        </div>
                        <span class="text-gray-800">•</span>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Updated {{ $tag->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes with this Tag -->
            <div class="mt-6">
                <div class="flex items-center justify-between mb-4 px-2">
                    <h3 class="text-xs uppercase tracking-wider text-gray-600 font-semibold">
                        Notes with this tag
                    </h3>
                    <span class="text-xs text-gray-700">{{ $notes->total() }} {{ Str::plural('note', $notes->total()) }}</span>
                </div>

                <div class="space-y-3">
                    @forelse ($notes as $note)
                        <div class="group bg-[#252525] hover:bg-[#2a2a2a] border border-gray-800/50 hover:border-gray-700/50 rounded-lg transition-all">
                            <a href="{{ route('notes.show', $note) }}" class="block p-5">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base font-medium text-gray-100 group-hover:text-white transition-colors mb-2">
                                            {{ $note->title }}
                                        </h4>
                                        <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed mb-2">
                                            {{ Str::limit($note->content, 150) }}
                                        </p>
                                        <div class="flex items-center text-xs text-gray-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $note->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12">
                            <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-base font-medium text-gray-300 mb-2">No notes with this tag</h4>
                            <p class="text-sm text-gray-600">Add this tag to your notes to see them here</p>
                        </div>
                    @endforelse
                </div>

                @if ($notes->hasPages())
                    <div class="mt-6">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>