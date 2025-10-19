<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with Create Button -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-sm text-gray-500">Manage your tags</h3>
                    <p class="text-xs text-gray-600 mt-1">Organize your notes with custom tags</p>
                </div>
                <a href="{{ route('tags.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#2a2a2a] hover:bg-[#2e2e2e] border border-gray-800/50 hover:border-gray-700/50 rounded-lg text-sm text-gray-300 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Tag
                </a>
            </div>

            <!-- Tags Grid -->
            @forelse ($tags as $tag)
                <div class="group bg-[#252525] hover:bg-[#2a2a2a] border border-gray-800/50 hover:border-gray-700/50 rounded-lg mb-3 transition-all overflow-hidden">
                    <div class="flex items-center justify-between p-5">
                        <a href="{{ route('tags.show', $tag) }}" class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-purple-600/10 group-hover:bg-purple-600/20 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-purple-500 group-hover:text-purple-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-medium text-gray-200 group-hover:text-white transition-colors truncate">
                                    {{ $tag->name }}
                                </h3>
                                <p class="text-xs text-gray-600 mt-0.5">
                                    {{ $tag->notes_count ?? 0 }} {{ Str::plural('note', $tag->notes_count ?? 0) }}
                                </p>
                            </div>
                        </a>
                        
                        <div class="flex items-center gap-2 ml-4">
                            <a href="{{ route('tags.edit', $tag) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-800/50 hover:bg-gray-800 border border-gray-700/50 rounded-md text-xs text-gray-400 hover:text-gray-200 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
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
                </div>
            @empty
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 bg-gray-800/50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-300 mb-2">No tags yet</h3>
                    <p class="text-sm text-gray-600 mb-6">Create tags to organize your notes</p>
                    <a href="{{ route('tags.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#2a2a2a] hover:bg-[#2e2e2e] border border-gray-800/50 hover:border-gray-700/50 text-gray-300 text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create your first tag
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>