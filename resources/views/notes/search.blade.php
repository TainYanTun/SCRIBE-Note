<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Search Notes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Filters and Bar -->
            <div class="mb-6 bg-[#191919] rounded-xl p-6 shadow-sm">
                <form action="{{ route('notes.search') }}" method="GET" class="space-y-5">
                    <!-- Keyword Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-400 mb-2">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <x-text-input
                                id="search"
                                class="block w-full pl-10 pr-4 py-2 bg-[#202020] border border-[#2f2f2f] text-gray-100 text-sm placeholder-gray-500 rounded-md hover:bg-[#252525] focus:bg-[#252525] focus:ring-0 focus:border-[#3f3f3f] transition-all duration-200"
                                type="text"
                                name="search"
                                placeholder="Search by title or content..."
                                value="{{ $search }}"
                            />
                        </div>
                    </div>

                    <!-- Advanced Filters Divider -->
                    <div class="flex items-center gap-3 pt-1">
                        <div class="h-px flex-1 bg-[#2f2f2f]"></div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider font-medium">Filters</span>
                        <div class="h-px flex-1 bg-[#2f2f2f]"></div>
                    </div>

                    <!-- Tags Filter -->
                    <div x-data="{ open: false, selectedTags: @json($selectedTags) }" class="relative">
                        <label for="tags" class="block text-sm font-medium text-gray-400 mb-2">Tags</label>
                        <button type="button" @click="open = !open" class="flex items-center justify-between w-full px-3.5 py-2 text-sm text-gray-100 bg-[#202020] border border-[#2f2f2f] rounded-md hover:bg-[#252525] focus:bg-[#252525] focus:ring-0 focus:border-[#3f3f3f] transition-all duration-200">
                            <span class="text-gray-400" x-text="selectedTags.length ? `${selectedTags.length} tag${selectedTags.length > 1 ? 's' : ''} selected` : 'Select tags'"></span>
                            <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @click.outside="open = false" 
                             class="absolute z-10 mt-2 w-full bg-[#202020] rounded-md shadow-lg border border-[#2f2f2f] max-h-60 overflow-y-auto"
                             style="display: none;">
                            @foreach ($allTags as $tag)
                                <label class="flex items-center px-3.5 py-2.5 text-sm text-gray-300 hover:bg-[#252525] cursor-pointer transition-colors duration-150 first:rounded-t-md last:rounded-b-md">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" x-model="selectedTags" class="form-checkbox h-4 w-4 text-blue-500 bg-[#2f2f2f] border-[#3f3f3f] rounded focus:ring-1 focus:ring-blue-500 focus:ring-offset-0">
                                    <span class="ml-3">{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date_start" class="block text-sm font-medium text-gray-400 mb-2">From</label>
                            <x-text-input
                                id="date_start"
                                class="block w-full px-3.5 py-2 bg-[#202020] border border-[#2f2f2f] text-gray-100 text-sm placeholder-gray-500 rounded-md hover:bg-[#252525] focus:bg-[#252525] focus:ring-0 focus:border-[#3f3f3f] transition-all duration-200"
                                type="date"
                                name="date_start"
                                value="{{ $dateStart }}"
                            />
                        </div>
                        <div>
                            <label for="date_end" class="block text-sm font-medium text-gray-400 mb-2">To</label>
                            <x-text-input
                                id="date_end"
                                class="block w-full px-3.5 py-2 bg-[#202020] border border-[#2f2f2f] text-gray-100 text-sm placeholder-gray-500 rounded-md hover:bg-[#252525] focus:bg-[#252525] focus:ring-0 focus:border-[#3f3f3f] transition-all duration-200"
                                type="date"
                                name="date_end"
                                value="{{ $dateEnd }}"
                            />
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="sort_by" class="block text-sm font-medium text-gray-400 mb-2">Sort by</label>
                            <select id="sort_by" name="sort_by" class="block w-full px-3.5 py-2 bg-[#202020] border border-[#2f2f2f] text-gray-100 text-sm rounded-md hover:bg-[#252525] focus:bg-[#252525] focus:ring-0 focus:border-[#3f3f3f] transition-all duration-200">
                                <option value="latest" @if($sortBy === 'latest') selected @endif>Latest</option>
                                <option value="oldest" @if($sortBy === 'oldest') selected @endif>Oldest</option>
                                <option value="title" @if($sortBy === 'title') selected @endif>Title</option>
                                <option value="updated_at" @if($sortBy === 'updated_at') selected @endif>Last Updated</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-400 mb-2">Order</label>
                            <select id="sort_order" name="sort_order" class="block w-full px-3.5 py-2 bg-[#202020] border border-[#2f2f2f] text-gray-100 text-sm rounded-md hover:bg-[#252525] focus:bg-[#252525] focus:ring-0 focus:border-[#3f3f3f] transition-all duration-200">
                                <option value="desc" @if($sortOrder === 'desc') selected @endif>Descending</option>
                                <option value="asc" @if($sortOrder === 'asc') selected @endif>Ascending</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-2">
                        <x-primary-button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-[#191919]">
                            Apply Filters
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <div class="space-y-1.5">
                @forelse ($notes as $note)
                    <div class="group bg-[#191919] hover:bg-[#202020] rounded-lg transition-all duration-200 border border-transparent hover:border-[#2f2f2f]">
                        <a href="{{ route('notes.show', $note) }}" class="block p-4">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-200 group-hover:text-gray-100 mb-1 transition-colors duration-200">
                                        {{ $note->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 leading-relaxed mb-2 line-clamp-2">
                                        @php
                                            $snippet = Str::limit(strip_tags($note->content), 150);
                                            if ($search) {
                                                $snippet = preg_replace('/' . preg_quote($search, '/') . '/i', '<mark class="bg-yellow-500/20 text-yellow-200 rounded px-1">$0</mark>', $snippet);
                                            }
                                        @endphp
                                        {!! $snippet !!}
                                    </p>
                                    <div class="flex items-center gap-1 text-xs text-gray-600">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $note->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-16 bg-[#191919] rounded-xl">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-[#252525] mb-4">
                            <svg class="h-7 w-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base font-medium text-gray-300 mb-1">No notes found</h3>
                        <p class="text-sm text-gray-500">Try adjusting your search or filters</p>
                    </div>
                @endforelse

                <div class="mt-8">
                    {{ $notes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>