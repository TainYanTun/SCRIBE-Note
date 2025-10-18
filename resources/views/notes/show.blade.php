<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Note Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#282828] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">{{ $note->title }}</h3>
                    <p class="text-gray-300 mb-4 break-words">{!! nl2br($note->content) !!}</p>
                    <p class="text-sm text-gray-400">Created: {{ $note->created_at->format('M d, Y H:i') }}</p>
                    <p class="text-sm text-gray-400">Last updated: {{ $note->updated_at->format('M d, Y H:i') }}</p>

                    @if ($note->tags->isNotEmpty())
                        <div class="mt-4">
                            <h4 class="font-semibold">Tags:</h4>
                            <div class="flex flex-wrap gap-2 mt-2">
                                @foreach ($note->tags as $tag)
                                    <span class="bg-indigo-800 text-indigo-100 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($note->linkedNotes->isNotEmpty())
                        <div class="mt-4">
                            <h4 class="font-semibold">Linked Notes:</h4>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($note->linkedNotes as $linkedNote)
                                    <li><a href="{{ route('notes.show', $linkedNote) }}" class="text-indigo-400 hover:text-indigo-200">{{ $linkedNote->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-6 flex space-x-2">
                        
                        <a href="{{ route('notes.edit', $note) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Edit Note') }}
                        </a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="bg-red-600 hover:bg-red-700 active:bg-red-900">
                                {{ __('Delete Note') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>