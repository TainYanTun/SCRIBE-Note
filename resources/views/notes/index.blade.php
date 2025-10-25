<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('My Notes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($groupedNotes as $date => $notesByDay)
                <!-- Date Header -->
                <div class="mb-4">
                    <div class="flex items-center gap-3 px-2">
                        <h3 class="text-xs uppercase tracking-wider text-gray-600 font-semibold">
                            {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                        </h3>
                        <div class="flex-1 h-px bg-gray-800/50"></div>
                        <span class="text-xs text-gray-700">{{ count($notesByDay) }} {{ Str::plural('note', count($notesByDay)) }}</span>
                    </div>
                </div>

                <!-- Notes Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    @foreach ($notesByDay as $note)
                        <div class="group bg-[#252525] hover:bg-[#2a2a2a] border border-gray-800/50 hover:border-gray-700/50 rounded-lg transition-all duration-200 overflow-hidden">
                            <a href="{{ route('notes.show', $note) }}" class="block p-5">
                                <!-- Note Icon & Title -->
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base font-semibold text-gray-100 group-hover:text-white transition-colors line-clamp-2 mb-1">
                                            {{ $note->title }}
                                        </h4>
                                        @if ($note->user_id !== Auth::id())
                                            <div class="flex items-center text-xs text-gray-500 mt-1">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.516 3.832a3 3 0 00.617-.245M8.684 10.658L15.2 6.826a3 3 0 01.617-.245m0 0a3 3 0 105.329 2.538 3 3 0 00-5.329-2.538m0 0L8.684 10.658"></path></svg>
                                                Shared by: <span class="font-semibold ml-1">{{ $note->user->name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Note Preview -->
                                <p class="text-sm text-gray-500 line-clamp-3 leading-relaxed mb-4">
                                    {{ Str::limit($note->content, 120) }}
                                </p>

                                <!-- Metadata -->
                                <div class="flex items-center justify-between text-xs text-gray-700">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $note->updated_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    @if($note->tags->isNotEmpty())
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            <span>{{ $note->tags->count() }}</span>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <!-- Quick Actions Bar -->
                            <div class="flex items-center gap-1 px-3 py-2 border-t border-gray-800/50 bg-[#222222]/50">
                                <a href="{{ route('notes.show', $note) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-2 py-1.5 text-xs text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('notes.edit', $note) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-2 py-1.5 text-xs text-gray-400 hover:text-gray-200 hover:bg-white/5 rounded transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 px-2 py-1.5 text-xs text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 bg-gray-800/50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-300 mb-2">No notes yet</h3>
                    <p class="text-sm text-gray-600 mb-6">Start capturing your thoughts and ideas</p>
                    <a href="{{ route('notes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create your first note
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>