<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Edit Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#282828] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('tags.update', $tag) }}">
                        @csrf
                        @method('patch')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Tag Name')" class="text-gray-300" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100" type="text" name="name" :value="old('name', $tag->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" class="text-gray-300" />
                            <textarea id="description" name="description" class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 rounded-md shadow-sm">{{ old('description', $tag->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>