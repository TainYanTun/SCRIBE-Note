<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 border border-blue-600/20 rounded-lg p-6 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-100">{{ __("Welcome to Scribe!") }}</h3>
                        <p class="text-sm text-gray-400">{{ __("Ready to manage your notes and ideas") }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- Total Notes Stat -->
                <div class="bg-[#252525] border border-gray-800/50 rounded-lg p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-600 font-semibold mb-1">Your Notes</p>
                            <p class="text-3xl font-bold text-gray-100">{{ $totalNotes }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-600/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Tags Stat -->
                <div class="bg-[#252525] border border-gray-800/50 rounded-lg p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-600 font-semibold mb-1">Attached Tags</p>
                            <p class="text-3xl font-bold text-gray-100">{{ $totalTags }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-600/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5.5c.58 0 1.13.2 1.55.55L20 10l-7 7-5.45-5.45c-.35-.42-.55-.97-.55-1.55V7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Note Links Stat -->
                <div class="bg-[#252525] border border-gray-800/50 rounded-lg p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-600 font-semibold mb-1">Total Note Links</p>
                            <p class="text-3xl font-bold text-gray-100">{{ $totalNoteLinks }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-600/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.102 1.101"></path></svg>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Notes and Tags Section -->

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Notes Tabbed Interface -->

                            <div x-data="{ tab: 'recent' }" class="bg-[#252525] border border-gray-800/50 rounded-lg overflow-hidden">

                                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800/50">

                                    <div class="flex items-center gap-2">

                                        <h3 class="text-base font-semibold text-gray-100">Notes</h3>

                                    </div>

                                    <div class="flex items-center gap-2">

                                        <button @click="tab = 'recent'" :class="{ 'bg-gray-700 text-white': tab === 'recent', 'text-gray-400 hover:bg-gray-700/50': tab !== 'recent' }" class="px-3 py-1 text-sm font-medium rounded-md transition-colors">Recent</button>

                                        <button @click="tab = 'favorites'" :class="{ 'bg-gray-700 text-white': tab === 'favorites', 'text-gray-400 hover:bg-gray-700/50': tab !== 'favorites' }" class="px-3 py-1 text-sm font-medium rounded-md transition-colors">Favorites</button>

                                        <button @click="tab = 'important'" :class="{ 'bg-gray-700 text-white': tab === 'important', 'text-gray-400 hover:bg-gray-700/50': tab !== 'important' }" class="px-3 py-1 text-sm font-medium rounded-md transition-colors">Important</button>

                                    </div>

                                </div>

            

                                <!-- Recent Notes -->

                                <div x-show="tab === 'recent'" class="divide-y divide-gray-800/50">

                                    @if ($notes->isEmpty())

                                        <div class="flex flex-col items-center justify-center py-12 px-6">

                                            <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4">

                                                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>

                                            </div>

                                            <h4 class="text-base font-medium text-gray-300 mb-2">No notes yet</h4>

                                            <p class="text-sm text-gray-600 mb-4 text-center">Start your journey by creating your first note</p>

                                            <a href="{{ route('notes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>

                                                Create your first note

                                            </a>

                                        </div>

                                    @else

                                        @foreach ($notes as $note)

                                            <a href="{{ route('notes.show', $note) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-[#2a2a2a] transition-colors group">

                                                <div class="flex-1 min-w-0">

                                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors truncate">{{ $note->title }}</h4>

                                                    <div class="flex items-center gap-2 mt-1">

                                                        <span class="text-xs text-gray-600">{{ $note->updated_at->diffForHumans() }}</span>

                                                    </div>

                                                </div>

                                            </a>

                                        @endforeach

                                    @endif

                                </div>

            

                                <!-- Favorites Notes -->

                                <div x-show="tab === 'favorites'" class="divide-y divide-gray-800/50">

                                    @if ($favoriteNotes->isEmpty())

                                        <div class="px-6 py-4 text-sm text-gray-500">No favorite notes.</div>

                                    @else

                                        @foreach ($favoriteNotes as $note)

                                            <a href="{{ route('notes.show', $note) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-[#2a2a2a] transition-colors group">

                                                <div class="flex-1 min-w-0">

                                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors truncate">{{ $note->title }}</h4>

                                                </div>

                                            </a>

                                        @endforeach

                                    @endif

                                </div>

            

                                <!-- Important Notes -->

                                <div x-show="tab === 'important'" class="divide-y divide-gray-800/50">

                                    @if ($importantNotes->isEmpty())

                                        <div class="px-6 py-4 text-sm text-gray-500">No important notes.</div>

                                    @else

                                        @foreach ($importantNotes as $note)

                                            <a href="{{ route('notes.show', $note) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-[#2a2a2a] transition-colors group">

                                                <div class="flex-1 min-w-0">

                                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors truncate">{{ $note->title }}</h4>

                                                </div>

                                            </a>

                                        @endforeach

                                    @endif

                                </div>

            

                                <!-- Footer Action -->

                                <div class="px-6 py-4 bg-[#222222]/50 border-t border-gray-800/50">

                                    <a href="{{ route('notes.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800/50 hover:bg-gray-800 text-gray-300 text-sm font-medium rounded-lg transition-colors w-full justify-center">

                                        View All Notes

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>

                                        </svg>

                                    </a>

                                </div>

                            </div>

            

                            <!-- Tags Section -->

                            <div class="bg-[#252525] border border-gray-800/50 rounded-lg overflow-hidden">

                                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800/50">

                                    <div class="flex items-center gap-2">

                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5.5c.58 0 1.13.2 1.55.55L20 10l-7 7-5.45-5.45c-.35-.42-.55-.97-.55-1.55V7z"></path></svg>

                                        <h3 class="text-base font-semibold text-gray-100">Your Tags</h3>

                                    </div>

                                    @if (!$allTags->isEmpty())

                                        <a href="{{ route('tags.index') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1">

                                            View All

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>

                                        </a>

                                    @endif

                                </div>

            

                                @if ($allTags->isEmpty())

                                    <div class="flex flex-col items-center justify-center py-12 px-6">

                                        <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4">

                                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5.5c.58 0 1.13.2 1.55.55L20 10l-7 7-5.45-5.45c-.35-.42-.55-.97-.55-1.55V7z"></path></svg>

                                        </div>

                                        <h4 class="text-base font-medium text-gray-300 mb-2">No tags yet</h4>

                                        <p class="text-sm text-gray-600 mb-4 text-center">Organize your notes with tags</p>

                                        <a href="{{ route('tags.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>

                                            Create your first tag

                                        </a>

                                    </div>

                                @else

                                                                    <div class="divide-y divide-gray-800/50">

                                                                            @foreach ($allTags->take(7) as $tag)

                                                                                <a href="{{ route('tags.show', $tag) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-[#2a2a2a] transition-colors group">

                                                                                    <div class="flex-1 min-w-0">

                                                                                        <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors truncate">#{{ $tag->name }}</h4>

                                                </div>

                                                <div class="flex-shrink-0">

                                                    <span class="text-xs text-gray-600">{{ $tag->notes_count }} notes</span>

                                                </div>

                                            </a>

                                        @endforeach

                                    </div>

                                    <div class="px-6 py-4 bg-[#222222]/50 border-t border-gray-800/50">

                                        <a href="{{ route('tags.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800/50 hover:bg-gray-800 text-gray-300 text-sm font-medium rounded-lg transition-colors w-full justify-center">

                                            View All Tags

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>

                                            </svg>

                                        </a>

                                    </div>

                                @endif

                            </div>

                        </div>

            

            <!-- Notifications Section -->
            <div class="mt-4">
                <div class="bg-[#252525] border border-gray-800/50 rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800/50">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <h3 class="text-base font-semibold text-gray-100">Recent Activity</h3>
                        </div>
                        @if (!$notifications->isEmpty())
                            <a href="{{ route('notifications.index') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1">
                                View All
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        @endif
                    </div>

                    @if ($notifications->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 px-6">
                            <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <h4 class="text-base font-medium text-gray-300 mb-2">No new notifications</h4>
                            <p class="text-sm text-gray-600 mb-4 text-center">You're all caught up!</p>
                        </div>
                    @else
                        <div class="divide-y divide-gray-800/50">
                            @foreach ($notifications as $notification)
                                <a href="{{ route('notifications.index') }}" class="flex items-center gap-4 px-6 py-4 hover:bg-[#2a2a2a] transition-colors group">
                                    <div class="flex-1 min-w-0">
                                                                                            <h4 class="text-sm font-medium text-gray-200 group-hover:text-white transition-colors">{{ $notification->data['sharer'] ?? 'Someone' }} has invited you to "{{ $notification->data['note_title'] ?? 'a note' }}" with {{ $notification->data['permission'] ?? 'view' }} permissions.</h4>                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-gray-600">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="px-6 py-4 bg-[#222222]/50 border-t border-gray-800/50">
                            <a href="{{ route('notifications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800/50 hover:bg-gray-800 text-gray-300 text-sm font-medium rounded-lg transition-colors w-full justify-center">
                                View All Notifications
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

