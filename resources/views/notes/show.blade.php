<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Note Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">{{ $note->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ $note->content }}</p>
                    <p class="text-sm text-gray-500">Created: {{ $note->created_at->format('M d, Y H:i') }}</p>
                    <p class="text-sm text-gray-500">Last updated: {{ $note->updated_at->format('M d, Y H:i') }}</p>

                    @if ($note->tags->isNotEmpty())
                        <div class="mt-4">
                            <h4 class="font-semibold">Tags:</h4>
                            <div class="flex flex-wrap gap-2 mt-2">
                                @foreach ($note->tags as $tag)
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($note->linkedNotes->isNotEmpty())
                        <div class="mt-4">
                            <h4 class="font-semibold">Linked Notes:</h4>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($note->linkedNotes as $linkedNote)
                                    <li><a href="{{ route('notes.show', $linkedNote) }}" class="text-indigo-600 hover:text-indigo-900">{{ $linkedNote->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-6 flex space-x-2">
                        <a href="{{ route('notes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Back to Notes') }}
                        </a>
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