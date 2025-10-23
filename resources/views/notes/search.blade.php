<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Search Notes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Filters and Bar -->
            <div class="mb-6 bg-[#252525] border border-gray-800/50 rounded-lg p-4">
                <form action="{{ route('notes.search') }}" method="GET" class="space-y-4">
                    <!-- Keyword Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-300 mb-1">Keyword</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <x-text-input
                                id="search"
                                class="block w-full pl-11 pr-4 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-500 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors"
                                type="text"
                                name="search"
                                placeholder="Search notes by title or content..."
                                value="{{ $search }}"
                            />
                        </div>
                    </div>

                    <!-- Tags Filter -->
                    <div x-data="{ open: false, selectedTags: @json($selectedTags) }" class="relative">
                        <label for="tags" class="block text-sm font-medium text-gray-300 mb-1">Tags</label>
                        <button type="button" @click="open = !open" class="flex items-center justify-between w-full px-4 py-2.5 text-sm text-gray-100 bg-[#2c2c2c] border-transparent rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors">
                            <span x-text="selectedTags.length ? `Selected (${selectedTags.length})` : 'Select Tags'"></span>
                            <svg class="h-5 w-5 text-gray-500" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 mt-1 w-full bg-[#2c2c2c] rounded-lg shadow-lg border border-gray-700 max-h-60 overflow-y-auto">
                            @foreach ($allTags as $tag)
                                <label class="flex items-center px-4 py-2 text-sm text-gray-100 hover:bg-[#323232] cursor-pointer">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" x-model="selectedTags" class="form-checkbox h-4 w-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                                    <span class="ml-2">{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date_start" class="block text-sm font-medium text-gray-300 mb-1">From Date</label>
                            <x-text-input
                                id="date_start"
                                class="block w-full px-4 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-500 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors"
                                type="date"
                                name="date_start"
                                value="{{ $dateStart }}"
                            />
                        </div>
                        <div>
                            <label for="date_end" class="block text-sm font-medium text-gray-300 mb-1">To Date</label>
                            <x-text-input
                                id="date_end"
                                class="block w-full px-4 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-500 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors"
                                type="date"
                                name="date_end"
                                value="{{ $dateEnd }}"
                            />
                        </div>
                    </div>

                    <!-- Sort By and Order -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="sort_by" class="block text-sm font-medium text-gray-300 mb-1">Sort By</label>
                            <select id="sort_by" name="sort_by" class="block w-full px-4 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors">
                                <option value="latest" @if($sortBy === 'latest') selected @endif>Latest</option>
                                <option value="oldest" @if($sortBy === 'oldest') selected @endif>Oldest</option>
                                <option value="title" @if($sortBy === 'title') selected @endif>Title</option>
                                <option value="updated_at" @if($sortBy === 'updated_at') selected @endif>Last Updated</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-300 mb-1">Sort Order</label>
                            <select id="sort_order" name="sort_order" class="block w-full px-4 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors">
                                <option value="desc" @if($sortOrder === 'desc') selected @endif>Descending</option>
                                <option value="asc" @if($sortOrder === 'asc') selected @endif>Ascending</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <x-primary-button class="px-6 py-2.5">
                            Apply Filters
                        </x-primary-button>
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
                                            $snippet = Str::limit(strip_tags($note->content), 150);
                                            if ($search) {
                                                $snippet = preg_replace('/' . preg_quote($search, '/') . '/i', '<span class="bg-yellow-500/50 text-white">$0</span>', $snippet);
                                            }
                                        @endphp
                                        {!! $snippet !!}
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

                <div class="mt-6">
                    {{ $notes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>