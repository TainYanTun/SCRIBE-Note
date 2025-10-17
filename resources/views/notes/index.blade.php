<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <form action="{{ route('notes.index') }}" method="GET" class="flex items-center">
                            <x-text-input id="search" class="block w-full" type="text" name="search" placeholder="Search notes..." value="{{ request('search') }}" />
                            <x-primary-button class="ms-2">
                                {{ __('Search') }}
                            </x-primary-button>
                        </form>
                        <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Create New Note') }}
                        </a>
                    </div>

                    @forelse ($notes as $note)
                        <div class="mb-4 p-4 bg-gray-100 rounded-lg">
                            <h3 class="text-lg font-semibold">
                                <a href="{{ route('notes.show', $note) }}" class="text-indigo-600 hover:text-indigo-900">
                                    {{ $note->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600">
                                @php
                                    $lines = explode("\n", $note->content);
                                    $displayContent = implode("\n", array_slice($lines, 0, 1));
                                @endphp
                                {!! nl2br(e($displayContent)) !!}@if (count($lines) > 1)...@endif
                            </p>
                            <p class="text-xs text-gray-500">Last updated: {{ $note->updated_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p>You don't have any notes yet. Start by creating one!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>