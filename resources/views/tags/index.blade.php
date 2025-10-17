<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('tags.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Create New Tag') }}
                        </a>
                    </div>

                    @forelse ($tags as $tag)
                        <div class="mb-4 p-4 bg-gray-100 rounded-lg flex justify-between items-center">
                            <h3 class="text-lg font-semibold">
                                <a href="{{ route('tags.show', $tag) }}" class="text-indigo-600 hover:text-indigo-900">
                                    {{ $tag->name }}
                                </a>
                            </h3>
                            <div class="flex space-x-2">
                                <a href="{{ route('tags.edit', $tag) }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="bg-red-600 hover:bg-red-700 active:bg-red-900">
                                        {{ __('Delete') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>No tags found. Create your first tag!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>