<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Share Note: ' . $note->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg border border-gray-800/50">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('notes.processShare', $note) }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('User Email (Gmail)')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Permission Level -->
                        <div class="mt-4">
                            <x-input-label for="permission" :value="__('Permission Level')" />
                            <select id="permission" name="permission" class="block mt-1 w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                <option value="edit">Can Edit, Comment & View</option>
                                <option value="comment">Can Comment & View</option>
                                <option value="view">Can Only View</option>
                            </select>
                            <x-input-error :messages="$errors->get('permission')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Share Note') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>