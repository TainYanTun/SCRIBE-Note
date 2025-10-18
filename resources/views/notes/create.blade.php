<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Create New Note') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <div class="p-8">
                    <form method="POST" action="{{ route('notes.store') }}" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-gray-400 text-sm font-medium mb-2" />
                            <x-text-input 
                                id="title" 
                                class="block w-full bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors text-lg py-3" 
                                type="text" 
                                name="title" 
                                :value="old('title')" 
                                placeholder="Untitled"
                                required 
                                autofocus 
                            />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div>
                            <x-input-label for="content" :value="__('Content')" class="text-gray-400 text-sm font-medium mb-2" />
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="12"
                                class="block w-full bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-600 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-lg shadow-sm transition-colors resize-none" 
                                placeholder="Start writing..."
                            >{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Linked Notes -->
                        <div>
                            <x-input-label for="linked_notes" :value="__('Linked Notes')" class="text-gray-400 text-sm font-medium mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                </div>
                                <select 
                                    id="linked_notes" 
                                    name="linked_notes[]" 
                                    class="block w-full pl-10 pr-3 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-lg shadow-sm transition-colors" 
                                    multiple
                                >
                                    @foreach($notes as $noteOption)
                                        <option value="{{ $noteOption->id }}" class="py-2">{{ $noteOption->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-1.5 text-xs text-gray-600">Hold Ctrl (Cmd on Mac) to select multiple notes</p>
                            <x-input-error :messages="$errors->get('linked_notes')" class="mt-2" />
                        </div>

                        <!-- Tags -->
                        <div>
                            <x-input-label for="tags" :value="__('Tags')" class="text-gray-400 text-sm font-medium mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <select 
                                    id="tags" 
                                    name="tags[]" 
                                    class="block w-full pl-10 pr-3 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-lg shadow-sm transition-colors" 
                                    multiple
                                >
                                    @foreach($tags as $tagOption)
                                        <option value="{{ $tagOption->id }}" class="py-2">{{ $tagOption->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-1.5 text-xs text-gray-600">Hold Ctrl (Cmd on Mac) to select multiple tags</p>
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-800/50">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-400 transition-colors">
                                Cancel
                            </a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 px-6 py-2.5 transition-colors">
                                {{ __('Save Note') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>