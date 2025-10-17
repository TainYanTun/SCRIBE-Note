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
                    @forelse ($notes as $note)
                        <div class="mb-4 p-4 bg-gray-100 rounded-lg">
                            <h3 class="text-lg font-semibold">{{ $note->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $note->content }}</p>
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