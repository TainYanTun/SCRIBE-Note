<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <div class="p-8">
                    <form method="POST" action="{{ route('notes.update', $note) }}" class="space-y-6" id="note-form">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="version" value="{{ $note->version }}">
                        
                        @if ($errors->has('version'))
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <div class="flex items-center">
                                    <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                    <div>
                                        <p class="font-bold">Conflict Detected!</p>
                                        <p class="text-sm">{{ $errors->first('version') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-gray-400 text-sm font-medium mb-2" />
                            <input 
                                id="title" 
                                class="block w-full bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent transition-colors text-lg py-3" 
                                type="text" 
                                name="title" 
                                value="{{ old('title', $note->title) }}" 
                                placeholder="Untitled"
                                required 
                                autofocus 
                            />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Linked Notes & Tags Row -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Linked Notes -->
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="h-3.5 w-3.5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    <x-input-label for="linked_notes" :value="__('Linked Notes')" class="text-gray-500 text-xs font-medium" />
                                </div>
                                <select 
                                    id="linked_notes" 
                                    name="linked_notes[]" 
                                    class="block w-full px-2.5 py-1.5 text-sm bg-[#2c2c2c] border-transparent text-gray-100 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-md transition-colors scrollbar-thin" 
                                    multiple
                                    size="4"
                                >
                                    @foreach($allNotes as $noteOption)
                                        <option value="{{ $noteOption->id }}" @selected(in_array($noteOption->id, $linkedNotes)) class="py-1">
                                            {{ $noteOption->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('linked_notes')" class="mt-1" />
                            </div>

                            <!-- Tags -->
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="h-3.5 w-3.5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <x-input-label for="tags" :value="__('Tags')" class="text-gray-500 text-xs font-medium" />
                                </div>
                                <select 
                                    id="tags" 
                                    name="tags[]" 
                                    class="block w-full px-2.5 py-1.5 text-sm bg-[#2c2c2c] border-transparent text-gray-100 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-md transition-colors scrollbar-thin" 
                                    multiple
                                    size="4"
                                >
                                    @foreach($allTags as $tagOption)
                                        <option value="{{ $tagOption->id }}" @selected(in_array($tagOption->id, $noteTags)) class="py-1">
                                            {{ $tagOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('tags')" class="mt-1" />
                            </div>
                        </div>

                        <!-- Folder -->
                        <div>
                            <x-input-label for="folder_id" :value="__('Folder')" class="text-gray-400 text-sm font-medium mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                </div>
                                <select 
                                    id="folder_id" 
                                    name="folder_id" 
                                    class="block w-full pl-10 pr-3 py-2.5 bg-[#2c2c2c] border-transparent text-gray-100 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-lg shadow-sm transition-colors scrollbar-thin"
                                >
                                    <option value="">None</option>
                                    @foreach($folders as $folder)
                                        <option value="{{ $folder->id }}" @selected($note->folder_id == $folder->id) class="py-2">{{ $folder->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('folder_id')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div>
                            <x-input-label for="content" :value="__('Content')" class="text-gray-400 text-sm font-medium mb-2" />
                            <div id="editor" style="height: 300px; background-color: #2c2c2c; color: #e3e3e3; border-radius: 0.5rem; border: 1px solid transparent;"></div>
                            <textarea name="content" id="content-textarea" style="display: none;">{{ old('content', $note->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-800/50">
                            <a href="{{ route('notes.show', $note) }}" class="text-sm text-gray-500 hover:text-gray-400 transition-colors">
                                Cancel
                            </a>
                            <x-primary-button id="save-changes-button" class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 px-6 py-2.5 transition-colors">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Start writing...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                        ['blockquote', 'code-block'],

                        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                        [{ 'direction': 'rtl' }],                         // text direction

                        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                        [{ 'font': [] }],
                        [{ 'align': [] }],

                        ['clean']                                         // remove formatting button
                    ]
                }
            });

            var form = document.getElementById('note-form');
            form.onsubmit = function() {
                var contentTextarea = document.getElementById('content-textarea');
                contentTextarea.value = quill.root.innerHTML;
            };

            // Load existing content (HTML directly into Quill)
            var existingHtmlContent = document.getElementById('content-textarea').value;
            if (existingHtmlContent) {
                quill.clipboard.dangerouslyPasteHTML(existingHtmlContent);
            }

        });
    </script>
    <div id="version-error-data" data-has-error="{{ json_encode($errors->has('version')) }}"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Disable save button if optimistic locking error is present
            const saveButton = document.getElementById('save-changes-button');
            const versionErrorDataElement = document.getElementById('version-error-data');
            const hasVersionError = versionErrorDataElement ? JSON.parse(versionErrorDataElement.dataset.hasError) : false;

            if (hasVersionError) {
                if (saveButton) {
                    saveButton.disabled = true;
                    saveButton.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }
        });
    </script>
    @endpush
</x-app-layout>