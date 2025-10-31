@php
    $search = request('search');
    $notesQuery = App\Models\Note::where('user_id', auth()->id());
    if ($search) {
        $notesQuery->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        });
    }
    $totalNotes = $notesQuery->count();
    $notes = $notesQuery->latest()->take(12)->get();
    $unreadNotificationsCount = auth()->user()->unreadNotifications->count();
    $specialTags = App\Models\Tag::whereIn('name', ['favorite', 'important', 'todo'])
                                 ->where('user_id', auth()->id())
                                 ->get();
@endphp

<div class="flex flex-col h-full bg-[#1d1d1d] border-r border-gray-800">
    <!-- Profile Section -->
    <div class="p-3 border-b border-gray-800/50">
        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
            <div @click="open = ! open">
                <button class="flex items-center w-full px-2 py-2 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-md object-cover mr-3">
                    @else
                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-gray-700 text-white text-sm font-semibold mr-3">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-1 text-left truncate" style="color: #e3e3e3;">{{ Auth::user()->name }}'s Scribe</div>
                    <svg class="fill-current h-4 w-4 ml-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute z-50 mt-2 w-48 rounded-md bg-[#1d1d1d] border border-gray-700 origin-top-left left-0"
                    style="display: none;"
                    @click="open = false">
                <div class="py-1">
                    <a href="{{ route('profile.settings') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-300 hover:bg-white/5 focus:outline-none focus:bg-white/5 transition duration-150 ease-in-out rounded-md">
                        {{ __('Profile Settings') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-300 hover:bg-white/5 focus:outline-none focus:bg-white/5 transition duration-150 ease-in-out rounded-md">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col flex-grow px-3 py-3 overflow-hidden">
        <!-- Navigation Links -->
        <div class="space-y-0.5 mb-6">
            <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('Home') }}
            </a>
                <a href="{{ route('folders.index') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                {{ __('All Files') }}
            </a>
            <a href="{{ route('notes.search') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                {{ __('Search') }}
            </a>
            <a href="{{ route('graph.index') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                {{ __('Graph View') }}
            </a>
            <a href="{{ route('notifications.index') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                {{ __('Notifications') }}
                @if ($unreadNotificationsCount > 0)
                    <span class="ml-3 mt-1 w-2 h-2 bg-blue-700 rounded-full"></span>
                @endif
            </a>
        </div>

        <!-- Create Note Button -->
        <a href="{{ route('notes.create') }}" class="flex items-center justify-center px-3 py-2 bg-white/10 hover:bg-white/15 border border-white/10 rounded-md text-sm text-gray-200 transition-colors duration-150 mb-6 w-full">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            {{ __('Create Note') }}
        </a>



        <!-- Notes List -->
        <div class="space-y-0.5 flex-grow min-h-0 flex flex-col">
            <div class="text-xs text-gray-500 uppercase tracking-wider px-2 py-1.5 font-semibold">
                Notes
            </div>
            <ul class="space-y-0.5 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent">
                @forelse ($notes as $note)
                    <li class="note-item">
                        <div class="relative">
                            <a href="{{ route('notes.show', $note) }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150 group w-full">
                                <svg class="w-4 h-4 mr-3 text-gray-500 group-hover:text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="truncate">{{ $note->title }}</span>
                            </a>
                            <div class="note-actions absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-0.5 bg-[#1d1d1d] pl-2">
                                <form action="{{ route('notes.toggleTag', $note) }}" method="POST" class="toggle-tag-form">
                                    @csrf
                                    <input type="hidden" name="tag" value="favorite">
                                    <button type="submit" class="p-1 rounded-md hover:bg-white/10 transition-colors">
                                        <svg class="w-3.5 h-3.5 {{ $note->tags->contains('name', 'favorite') ? 'text-yellow-400' : 'text-gray-500' }}" fill="{{ $note->tags->contains('name', 'favorite') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('notes.toggleTag', $note) }}" method="POST" class="toggle-tag-form">
                                    @csrf
                                    <input type="hidden" name="tag" value="important">
                                    <button type="submit" class="p-1 rounded-md hover:bg-white/10 transition-colors">
                                        <svg class="w-3.5 h-3.5 {{ $note->tags->contains('name', 'important') ? 'text-red-500' : 'text-gray-500' }}" fill="{{ $note->tags->contains('name', 'important') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('notes.toggleTag', $note) }}" method="POST" class="toggle-tag-form">
                                    @csrf
                                    <input type="hidden" name="tag" value="todo">
                                    <button type="submit" class="p-1 rounded-md hover:bg-white/10 transition-colors">
                                        <svg class="w-3.5 h-3.5 {{ $note->tags->contains('name', 'todo') ? 'text-blue-500' : 'text-gray-500' }}" fill="{{ $note->tags->contains('name', 'todo') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>
                        <p class="px-2 py-1.5 text-sm text-gray-500">No notes found.</p>
                    </li>
                @endforelse

                @if ($totalNotes > 8)
                    <li class="pt-1">
                        <a href="{{ route('notes.index') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-400 hover:bg-white/5 rounded-md transition-colors duration-150 group">
                            <svg class="w-4 h-4 mr-3 text-gray-500 group-hover:text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <span class="group-hover:text-gray-200">View all notes ({{ $totalNotes }})</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Help Link -->
        <div class="mt-auto pt-3 border-t border-gray-800/50">
            <a href="{{ route('help.index') }}" class="flex items-center justify-between px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.125-.904.47-.904.733V15m-6.564-1.154L14.44 17.55l2.156-2.156m-4.288-5.788l-2.156 2.156m-4.288-5.788l-2.156 2.156M12 6v.01M12 18v.01"></path>
                    </svg>
                    {{ __('Seek help here') }}
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.toggle-tag-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            });
        });
    });
</script>

<style>
    .note-item {
        position: relative;
    }

    .note-item .note-actions {
        display: none;
        pointer-events: none;
    }

    .note-item:hover .note-actions {
        display: flex;
        pointer-events: auto;
    }

    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #3f3f3f;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #4f4f4f;
    }
</style>