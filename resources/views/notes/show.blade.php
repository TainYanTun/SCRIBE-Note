<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Note Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Note Container -->
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <!-- Header Actions -->
                <div class="flex items-center justify-between px-8 pt-6 pb-4 border-b border-gray-800/30">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $note->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ route('notes.export', $note) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-600/10 hover:bg-gray-600/20 border border-gray-600/30 rounded-md text-xs text-gray-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export
                        </a>
                        <a href="{{ route('notes.edit', $note) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600/10 hover:bg-blue-600/20 border border-blue-600/30 rounded-md text-xs text-blue-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <a href="{{ route('notes.share', $note) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-600/10 hover:bg-purple-600/20 border border-purple-600/30 rounded-md text-xs text-purple-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Share
                        </a>
                        <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Are you sure you want to delete this note?');" class="inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600/10 hover:bg-red-600/20 border border-red-600/30 rounded-md text-xs text-red-400 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Title -->
                <div class="px-8 pt-8 pb-4">
                    <h1 class="text-4xl font-bold text-gray-100 mb-3">{{ $note->title }}</h1>
                    
                    <!-- Metadata Row -->
                    <div class="flex items-center gap-4 text-xs text-gray-600">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Created {{ $note->created_at->format('M d, Y') }}</span>
                        </div>
                        <span class="text-gray-800">•</span>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Updated {{ $note->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tags & Linked Notes (Compact Pills) -->
                @if ($note->tags->isNotEmpty() || $note->linkedNotes->isNotEmpty())
                    <div class="px-8 pb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            @foreach ($note->tags as $tag)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-purple-600/10 border border-purple-600/20 text-purple-400 text-[11px] font-medium rounded-md">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                            
                            @foreach ($note->linkedNotes as $linkedNote)
                                <a href="{{ route('notes.show', $linkedNote) }}" class="inline-flex items-center gap-1 px-2 py-0.5 bg-blue-600/10 border border-blue-600/20 text-blue-400 text-[11px] font-medium rounded-md hover:bg-blue-600/20 transition-colors">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    {{ $linkedNote->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Divider -->
                <div class="px-8 pb-4">
                    <div class="border-t border-gray-800/50"></div>
                </div>

                <!-- Content -->
                <div class="px-8 pb-8">
                    <div id="markdown-output" class="prose prose-invert prose-sm max-w-none text-gray-300 leading-relaxed"></div>
                </div>
            </div>

            <!-- Linked Notes Section (if any) -->
            @if ($note->linkedNotes->isNotEmpty())
                <div class="mt-6">
                    <h3 class="text-xs uppercase tracking-wider text-gray-600 font-semibold mb-3 px-2">Connected Notes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($note->linkedNotes as $linkedNote)
                            <a href="{{ route('notes.show', $linkedNote) }}" class="group block bg-[#252525] hover:bg-[#2a2a2a] border border-gray-800/50 hover:border-gray-700/50 rounded-lg p-4 transition-all">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-gray-600 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-200 group-hover:text-blue-400 transition-colors truncate">{{ $linkedNote->title }}</h4>
                                        <p class="text-xs text-gray-600 mt-1">{{ $linkedNote->updated_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Comments Section -->
            <div class="mt-6">
                <h3 class="text-xs uppercase tracking-wider text-gray-600 font-semibold mb-3 px-2">Comments</h3>
                <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50 p-6">
                    @can('comment', $note)
                        <form method="POST" action="{{ route('notes.comments.store', $note) }}" class="mb-6">
                            @csrf
                            <div>
                                <x-input-label for="comment_content" :value="__('Add a comment')" class="text-gray-400 text-sm" />
                                <textarea id="comment_content" name="content" class="block mt-1 w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-gray-600 focus:ring-gray-600 rounded-md shadow-sm p-2" rows="3" required>{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Post Comment') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endcan

                    @forelse ($note->comments as $comment)
                        <div class="border-b border-gray-800/50 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                            <div class="flex items-center gap-3">
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&color=7F9CF5&background=EBF4FF' }}" alt="{{ $comment->user->name }}">
                                <div>
                                    <p class="text-sm text-gray-400 font-semibold">{{ $comment->user->name }}</p>
                                    <p class="text-xs text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-gray-300 mt-2">{{ $comment->content }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const markdownContent = `{!! addslashes($note->content) !!}`;
        
        // Configure marked.js options for better rendering
        marked.setOptions({
            breaks: true,
            gfm: true,
            headerIds: true,
            mangle: false
        });
        
        document.getElementById('markdown-output').innerHTML = marked.parse(markdownContent);
    });
</script>

<style>
    /* Markdown Content Styling */
    #markdown-output {
        line-height: 1.7;
        color: #e5e5e5;
    }
    
    /* Headers */
    #markdown-output h1 {
        font-size: 2em;
        font-weight: bold;
        margin-top: 1em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        border-bottom: 2px solid #4b5563;
        padding-bottom: 0.3em;
        line-height: 1.3;
    }
    
    #markdown-output h1:first-child {
        margin-top: 0;
    }
    
    #markdown-output h2 {
        font-size: 1.5em;
        font-weight: bold;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        border-bottom: 1px solid #4b5563;
        padding-bottom: 0.3em;
        line-height: 1.3;
    }
    
    #markdown-output h3 {
        font-size: 1.25em;
        font-weight: bold;
        margin-top: 1.3em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        line-height: 1.3;
    }
    
    #markdown-output h4 {
        font-size: 1.1em;
        font-weight: bold;
        margin-top: 1.2em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        line-height: 1.3;
    }
    
    #markdown-output h5,
    #markdown-output h6 {
        font-size: 1em;
        font-weight: bold;
        margin-top: 1em;
        margin-bottom: 0.5em;
        color: #f3f4f6;
        line-height: 1.3;
    }
    
    /* Paragraphs */
    #markdown-output p {
        margin-bottom: 1em;
        line-height: 1.7;
    }
    
    /* Lists */
    #markdown-output ul,
    #markdown-output ol {
        margin-bottom: 1em;
        margin-left: 1.5em;
        line-height: 1.7;
    }
    
    #markdown-output ul {
        list-style-type: disc;
    }
    
    #markdown-output ol {
        list-style-type: decimal;
    }
    
    #markdown-output li {
        margin-bottom: 0.25em;
        padding-left: 0.25em;
    }
    
    #markdown-output li > p {
        margin-bottom: 0.5em;
    }
    
    #markdown-output ul ul,
    #markdown-output ol ul {
        list-style-type: circle;
        margin-top: 0.25em;
    }
    
    #markdown-output ul ul ul,
    #markdown-output ol ul ul,
    #markdown-output ol ol ul {
        list-style-type: square;
    }
    
    /* Links */
    #markdown-output a {
        color: #60a5fa;
        text-decoration: none;
        border-bottom: 1px solid #60a5fa;
        transition: all 0.2s ease;
    }
    
    #markdown-output a:hover {
        color: #93c5fd;
        border-bottom-color: #93c5fd;
        background-color: rgba(96, 165, 250, 0.1);
    }
    
    /* Images */
    #markdown-output img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5em 0;
        border: 1px solid #4b5563;
        display: block;
    }
    
    /* Blockquotes */
    #markdown-output blockquote {
        border-left: 4px solid #4b5563;
        padding-left: 1em;
        margin-left: 0;
        margin-right: 0;
        margin-top: 1em;
        margin-bottom: 1em;
        color: #9ca3af;
        font-style: italic;
    }
    
    #markdown-output blockquote p {
        margin-bottom: 0.5em;
    }
    
    #markdown-output blockquote p:last-child {
        margin-bottom: 0;
    }
    
    /* Code */
    #markdown-output code {
        background-color: #1f2937;
        padding: 0.2em 0.4em;
        border-radius: 0.25rem;
        font-family: 'Courier New', Courier, monospace;
        font-size: 0.9em;
        color: #fbbf24;
    }
    
    #markdown-output pre {
        background-color: #1f2937;
        padding: 1em;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1em 0;
        border: 1px solid #374151;
    }
    
    #markdown-output pre code {
        background-color: transparent;
        padding: 0;
        border-radius: 0;
        color: #e5e5e5;
        font-size: 0.875em;
        line-height: 1.6;
    }
    
    /* Horizontal Rules */
    #markdown-output hr {
        border: none;
        border-top: 1px solid #4b5563;
        margin: 2em 0;
    }
    
    /* Tables */
    #markdown-output table {
        border-collapse: collapse;
        width: 100%;
        margin: 1em 0;
        overflow: hidden;
        border-radius: 0.5rem;
    }
    
    #markdown-output th,
    #markdown-output td {
        border: 1px solid #4b5563;
        padding: 0.75em;
        text-align: left;
    }
    
    #markdown-output th {
        background-color: #1f2937;
        font-weight: bold;
        color: #f3f4f6;
    }
    
    #markdown-output tr:nth-child(even) {
        background-color: rgba(31, 41, 55, 0.3);
    }
    
    /* Strong and Emphasis */
    #markdown-output strong {
        font-weight: bold;
        color: #f3f4f6;
    }
    
    #markdown-output em {
        font-style: italic;
        color: #d1d5db;
    }
    
    /* Task Lists */
    #markdown-output input[type="checkbox"] {
        margin-right: 0.5em;
        cursor: pointer;
    }
    
    #markdown-output li.task-list-item {
        list-style-type: none;
        margin-left: -1.5em;
    }
    
    /* Strikethrough */
    #markdown-output del {
        text-decoration: line-through;
        color: #9ca3af;
    }
</style>
</x-app-layout>