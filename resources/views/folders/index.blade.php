<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $folder ? $folder->name : 'My Files' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('folders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $folder ? $folder->id : '' }}">
                        <div class="flex">
                            <input type="text" name="name" placeholder="New folder name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Create Folder
                            </button>
                        </div>
                    </form>

                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mt-6">Folders</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($folders as $subFolder)
                            <li class="py-4 flex justify-between items-center">
                                <a href="{{ route('folders.index', ['folder' => $subFolder->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $subFolder->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
