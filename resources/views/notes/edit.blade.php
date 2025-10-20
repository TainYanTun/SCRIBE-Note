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
                    <form method="POST" action="{{ route('notes.update', $note) }}" class="space-y-6">
                        @csrf
                        @method('patch')

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

                        <!-- Content -->
                        <div>
                            <x-input-label for="content" :value="__('Content')" class="text-gray-400 text-sm font-medium mb-2" />
                            <textarea 
                                id="easymde-editor" 
                                name="content" 
                                class="block w-full bg-[#2c2c2c] border-transparent text-gray-100 placeholder-gray-600 focus:bg-[#323232] focus:ring-1 focus:ring-gray-600 focus:border-transparent rounded-lg shadow-sm transition-colors"
                            >{{ old('content', $note->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-800/50">
                            <a href="{{ route('notes.show', $note) }}" class="text-sm text-gray-500 hover:text-gray-400 transition-colors">
                                Cancel
                            </a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500 px-6 py-2.5 transition-colors">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var easymde = new EasyMDE({
            element: document.getElementById('easymde-editor'),
            spellChecker: false,
            
            // Enable preview
            previewRender: function(plainText) {
                return this.parent.markdown(plainText);
            },
            
            // Toolbar configuration
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                "link", "image", "|",
                "preview", "side-by-side", "fullscreen", "|",
                "guide"
            ],
            
            // Enable rendering features
            renderingConfig: {
                singleLineBreaks: false,
                codeSyntaxHighlighting: true,
            },
            
            // Status bar
            status: ['lines', 'words', 'cursor'],
            
            // Auto-save (optional)
            autosave: {
                enabled: false
            }
        });
    });
</script>

<style>
    /* EasyMDE Dark Mode Styling */
    .EasyMDEContainer .CodeMirror {
        background-color: #2c2c2c;
        color: #e5e5e5;
        border: none;
        border-radius: 0.5rem;
        padding: 0.5rem;
        min-height: 300px;
    }
    
    .EasyMDEContainer .CodeMirror-cursor {
        border-left-color: #e5e5e5;
    }
    
    .EasyMDEContainer .CodeMirror-selected {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .EasyMDEContainer .CodeMirror-line::selection,
    .EasyMDEContainer .CodeMirror-line > span::selection,
    .EasyMDEContainer .CodeMirror-line > span > span::selection {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .editor-toolbar {
        background-color: #252525;
        border: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 0.5rem 0.5rem 0 0;
        opacity: 1;
    }
    
    .editor-toolbar button {
        color: #9ca3af !important;
        border: none !important;
    }
    
    .editor-toolbar button:hover,
    .editor-toolbar button.active {
        background-color: rgba(255, 255, 255, 0.05);
        color: #e5e5e5 !important;
        border: none !important;
    }
    
    .editor-toolbar i.separator {
        border-left: 1px solid rgba(255, 255, 255, 0.05);
        border-right: none;
    }
    
    .editor-statusbar {
        color: #6b7280;
        background-color: #252525;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 0 0 0.5rem 0.5rem;
    }
    
    /* Preview Styling */
    .editor-preview,
    .editor-preview-side {
        background-color: #2c2c2c;
        color: #e5e5e5;
        padding: 1rem;
    }
    
    /* Headers in preview */
    .editor-preview h1,
    .editor-preview-side h1 {
        font-size: 2em;
        font-weight: bold;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        border-bottom: 2px solid #4b5563;
        padding-bottom: 0.3em;
    }
    
    .editor-preview h2,
    .editor-preview-side h2 {
        font-size: 1.5em;
        font-weight: bold;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        border-bottom: 1px solid #4b5563;
        padding-bottom: 0.3em;
    }
    
    .editor-preview h3,
    .editor-preview-side h3 {
        font-size: 1.25em;
        font-weight: bold;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
    }
    
    .editor-preview h4,
    .editor-preview-side h4,
    .editor-preview h5,
    .editor-preview-side h5,
    .editor-preview h6,
    .editor-preview-side h6 {
        font-weight: bold;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
    }
    
    /* Lists in preview */
    .editor-preview ul,
    .editor-preview-side ul,
    .editor-preview ol,
    .editor-preview-side ol {
        margin-left: 1.5em;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
    }
    
    .editor-preview ul {
        list-style-type: disc;
    }
    
    .editor-preview ol {
        list-style-type: decimal;
    }
    
    .editor-preview li,
    .editor-preview-side li {
        margin-bottom: 0.25em;
        line-height: 1.6;
    }
    
    /* Links in preview */
    .editor-preview a,
    .editor-preview-side a {
        color: #60a5fa;
        text-decoration: none;
        border-bottom: 1px solid #60a5fa;
    }
    
    .editor-preview a:hover,
    .editor-preview-side a:hover {
        color: #93c5fd;
        border-bottom-color: #93c5fd;
    }
    
    /* Images in preview */
    .editor-preview img,
    .editor-preview-side img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1em 0;
        border: 1px solid #4b5563;
    }
    
    /* Paragraphs in preview */
    .editor-preview p,
    .editor-preview-side p {
        margin-bottom: 1em;
        line-height: 1.6;
    }
    
    /* Blockquotes in preview */
    .editor-preview blockquote,
    .editor-preview-side blockquote {
        border-left: 4px solid #4b5563;
        padding-left: 1em;
        margin-left: 0;
        color: #9ca3af;
        font-style: italic;
    }
    
    /* Code blocks in preview */
    .editor-preview code,
    .editor-preview-side code {
        background-color: #1f2937;
        padding: 0.2em 0.4em;
        border-radius: 0.25rem;
        font-family: monospace;
        font-size: 0.9em;
    }
    
    .editor-preview pre,
    .editor-preview-side pre {
        background-color: #1f2937;
        padding: 1em;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1em 0;
    }
    
    .editor-preview pre code,
    .editor-preview-side pre code {
        background-color: transparent;
        padding: 0;
    }
    
    .CodeMirror-scroll {
        min-height: 300px;
    }
</style>
</x-app-layout>