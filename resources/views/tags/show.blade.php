<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tag Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">{{ $tag->name }}</h3>
                    <p class="text-sm text-gray-500">Slug: {{ $tag->slug }}</p>
                    <p class="text-sm text-gray-500">Created: {{ $tag->created_at->format('M d, Y H:i') }}</p>
                    <p class="text-sm text-gray-500">Last updated: {{ $tag->updated_at->format('M d, Y H:i') }}</p>

                    <div class="mt-6 flex space-x-2">
                        <a href="{{ route('tags.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Back to Tags') }}
                        </a>
                        <a href="{{ route('tags.edit', $tag) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Edit Tag') }}
                        </a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="bg-red-600 hover:bg-red-700 active:bg-red-900">
                                {{ __('Delete Tag') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>