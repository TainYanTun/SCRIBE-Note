@php
    $search = request('search');
    $notesQuery = App\Models\Note::where('user_id', auth()->id());
    if ($search) {
        $notesQuery->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        });
    }
    $notes = $notesQuery->latest()->get();
@endphp

<div class="flex flex-col h-full bg-[#1d1d1d] border-r border-gray-800">
    <!-- Logo -->
    <div class="shrink-0 flex items-center justify-between p-4 border-b border-gray-800/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="block h-6 w-auto fill-current text-gray-100" />
        </a>
    </div>

    <div class="flex-grow px-3 py-2 overflow-hidden">
        <!-- Navigation Links -->
        <div class="space-y-1 mb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('Home') }}
            </a>
            <a href="{{ route('notes.search') }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                {{ __('Search') }}
            </a>
            <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                {{ __('Graph View') }}
            </a>
        </div>

        <!-- Create Note Button -->
        <a href="{{ route('notes.create') }}" class="flex items-center justify-center px-3 py-2 bg-white/10 hover:bg-white/15 border border-white/10 rounded-md text-sm text-gray-200 transition-colors duration-150 mb-4 w-full">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            {{ __('Create Note') }}
        </a>

        <!-- Notes List -->
        <div class="space-y-1">
            <div class="text-xs text-gray-500 uppercase tracking-wider px-2 py-1 font-semibold">
                Notes
            </div>
            <ul class="space-y-0.5 max-h-[calc(100vh-400px)] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent">
                @forelse ($notes as $note)
                    <li>
                        <a href="{{ route('notes.show', $note) }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150 group">
                            <svg class="note-icon-size mr-2 text-gray-500 group-hover:text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="truncate">{{ $note->title }}</span>
                        </a>
                    </li>
                @empty
                    <li>
                        <p class="px-2 py-1.5 text-sm text-gray-500">No notes found.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Settings Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:justify-center p-3 border-t border-gray-800/50">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center w-full px-2 py-2 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150">
                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-gradient-to-br from-blue-500 to-purple-600 text-white text-xs font-semibold mr-2">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 text-left truncate">{{ Auth::user()->name }}</div>
                    <svg class="fill-current h-4 w-4 ml-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>

<style>
    /* Custom scrollbar for Notion-like appearance */
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