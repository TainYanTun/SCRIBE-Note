<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <!-- Profile Information Card -->
            <div class="bg-[#191919] rounded-lg border border-[#2f2f2f] shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="p-8">
                    <section>
                        <header class="mb-6">
                            <h2 class="text-base font-semibold text-[#e9e9e7] mb-1.5">
                                {{ __('Profile Information') }}
                            </h2>
                            <p class="text-sm text-[#9b9a97] leading-relaxed">
                                {{ __("Update your account's profile information.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-5" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <!-- Profile Photo Section -->
                            @if ($user->profile_photo_path)
                                <div class="flex items-center gap-4 pb-5 border-b border-[#2f2f2f]">
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                                         alt="Profile Photo" 
                                         class="rounded-lg h-16 w-16 object-cover border border-[#2f2f2f]">
                                    <div class="flex-1">
                                        <label for="profile_photo" class="text-sm font-medium text-[#e9e9e7] block mb-1.5">
                                            {{ __('Profile Photo') }}
                                        </label>
                                        <input id="profile_photo" 
                                               name="profile_photo" 
                                               type="file" 
                                               class="text-sm text-[#9b9a97] file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#2f2f2f] file:text-[#e9e9e7] file:cursor-pointer hover:file:bg-[#3f3f3f] file:transition-colors">
                                    </div>
                                </div>
                            @else
                                <div class="pb-5 border-b border-[#2f2f2f]">
                                    <label for="profile_photo" class="text-sm font-medium text-[#e9e9e7] block mb-2">
                                        {{ __('Profile Photo') }}
                                    </label>
                                    <input id="profile_photo" 
                                           name="profile_photo" 
                                           type="file" 
                                           class="text-sm text-[#9b9a97] file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#2f2f2f] file:text-[#e9e9e7] file:cursor-pointer hover:file:bg-[#3f3f3f] file:transition-colors">
                                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                                </div>
                            @endif

                            <!-- Name Field -->
                            <div x-data="{ readonly: true }" class="pt-1">
                                <label for="name" class="text-sm font-medium text-[#e9e9e7] block mb-2">
                                    {{ __('Name') }}
                                </label>
                                <div class="flex items-center gap-3">
                                    <input id="name" 
                                           name="name" 
                                           type="text" 
                                           class="flex-1 bg-[#252525] border border-[#2f2f2f] text-[#e9e9e7] text-sm rounded-md px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#4a9eff]/40 focus:border-transparent transition-all placeholder:text-[#6b6b68]" 
                                           value="{{ old('name', $user->name) }}" 
                                           required 
                                           autofocus 
                                           autocomplete="name" 
                                           ::readonly="readonly" 
                                           x-ref="name" />
                                    <button @click.prevent="readonly = false; $nextTick(() => { $refs.name.focus() });" 
                                            x-show="readonly" 
                                            class="text-sm text-[#4a9eff] hover:text-[#6bb0ff] font-medium transition-colors px-2">
                                        Edit
                                    </button>
                                </div>
                                <x-input-error class="mt-2 text-xs" :messages="$errors->get('name')" />
                            </div>

                            <!-- Save Button -->
                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" 
                                        class="px-4 py-2 bg-[#2f2f2f] hover:bg-[#3f3f3f] text-[#e9e9e7] text-sm font-medium rounded-md transition-colors duration-200 border border-transparent hover:border-[#4f4f4f]">
                                    {{ __('Save') }}
                                </button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }"
                                       x-show="show"
                                       x-transition
                                       x-init="setTimeout(() => show = false, 2000)"
                                       class="text-sm text-[#9b9a97]">
                                        {{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="bg-[#191919] rounded-lg border border-[#2f2f2f] shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="p-8">
                    <section>
                        <header class="mb-6">
                            <h2 class="text-base font-semibold text-[#e9e9e7] mb-1.5">
                                {{ __('Update Password') }}
                            </h2>
                            <p class="text-sm text-[#9b9a97] leading-relaxed">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                            @csrf
                            @method('put')

                            <div>
                                <label for="current_password" class="text-sm font-medium text-[#e9e9e7] block mb-2">
                                    {{ __('Current Password') }}
                                </label>
                                <input id="current_password" 
                                       name="current_password" 
                                       type="password" 
                                       class="w-full bg-[#252525] border border-[#2f2f2f] text-[#e9e9e7] text-sm rounded-md px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#4a9eff]/40 focus:border-transparent transition-all" 
                                       autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs" />
                            </div>

                            <div>
                                <label for="password" class="text-sm font-medium text-[#e9e9e7] block mb-2">
                                    {{ __('New Password') }}
                                </label>
                                <input id="password" 
                                       name="password" 
                                       type="password" 
                                       class="w-full bg-[#252525] border border-[#2f2f2f] text-[#e9e9e7] text-sm rounded-md px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#4a9eff]/40 focus:border-transparent transition-all" 
                                       autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs" />
                            </div>

                            <div>
                                <label for="password_confirmation" class="text-sm font-medium text-[#e9e9e7] block mb-2">
                                    {{ __('Confirm Password') }}
                                </label>
                                <input id="password_confirmation" 
                                       name="password_confirmation" 
                                       type="password" 
                                       class="w-full bg-[#252525] border border-[#2f2f2f] text-[#e9e9e7] text-sm rounded-md px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#4a9eff]/40 focus:border-transparent transition-all" 
                                       autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs" />
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" 
                                        class="px-4 py-2 bg-[#2f2f2f] hover:bg-[#3f3f3f] text-[#e9e9e7] text-sm font-medium rounded-md transition-colors duration-200 border border-transparent hover:border-[#4f4f4f]">
                                    {{ __('Save') }}
                                </button>

                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }"
                                       x-show="show"
                                       x-transition
                                       x-init="setTimeout(() => show = false, 2000)"
                                       class="text-sm text-[#9b9a97]">
                                        {{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="bg-[#191919] rounded-lg border border-[#2f2f2f] shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="p-8">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-base font-semibold text-[#e9e9e7] mb-1.5">
                                {{ __('Delete Account') }}
                            </h2>
                            <p class="text-sm text-[#9b9a97] leading-relaxed">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>

                        <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="px-4 py-2 bg-[#3d2828] hover:bg-[#4d2f2f] text-[#ff6b6b] text-sm font-medium rounded-md transition-colors duration-200 border border-[#4d2f2f] hover:border-[#5d3535]">
                            {{ __('Delete Account') }}
                        </button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#191919]">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-semibold text-[#e9e9e7] mb-3">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>

                                <p class="text-sm text-[#9b9a97] leading-relaxed mb-6">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div class="mb-6">
                                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                                    <input id="password"
                                           name="password"
                                           type="password"
                                           class="w-3/4 bg-[#252525] border border-[#2f2f2f] text-[#e9e9e7] text-sm rounded-md px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#4a9eff]/40 focus:border-transparent transition-all placeholder:text-[#6b6b68]"
                                           placeholder="{{ __('Password') }}" />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs" />
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button type="button"
                                            x-on:click="$dispatch('close')"
                                            class="px-4 py-2 bg-[#2f2f2f] hover:bg-[#3f3f3f] text-[#e9e9e7] text-sm font-medium rounded-md transition-colors duration-200">
                                        {{ __('Cancel') }}
                                    </button>

                                    <button type="submit"
                                            class="px-4 py-2 bg-[#3d2828] hover:bg-[#4d2f2f] text-[#ff6b6b] text-sm font-medium rounded-md transition-colors duration-200 border border-[#4d2f2f] hover:border-[#5d3535]">
                                        {{ __('Delete Account') }}
                                    </button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>