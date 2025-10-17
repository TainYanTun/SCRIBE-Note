<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('notes.update', $note) }}">
                        @csrf
                        @method('patch')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <input id="title" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="title" value="{{ old('title', $note->title) }}" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" name="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content', $note->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Linked Notes -->
                        <div class="mt-4">
                            <x-input-label for="linked_notes" :value="__('Linked Notes')" />
                            <select id="linked_notes" name="linked_notes[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" multiple>
                                @foreach($allNotes as $noteOption)
                                    <option value="{{ $noteOption->id }}" @selected(in_array($noteOption->id, $linkedNotes))>
                                        {{ $noteOption->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('linked_notes')" class="mt-2" />
                        </div>

                        <!-- Tags -->
                        <div class="mt-4">
                            <x-input-label for="tags" :value="__('Tags')" />
                            <select id="tags" name="tags[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" multiple>
                                @foreach($allTags as $tagOption)
                                    <option value="{{ $tagOption->id }}" @selected(in_array($tagOption->id, $noteTags))>
                                        {{ $tagOption->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>