<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] border border-gray-800/50 sm:rounded-lg shadow-sm">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-800/50">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-100">Shared Note for {{ auth()->user()->name }}</h3>
                        </div>
                        @if ($notifications->whereNull('read_at')->count() > 0)
                            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-300 transition-colors px-3 py-1.5 hover:bg-white/5 rounded-md">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Mark All as Read
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Notifications List -->
                    <div class="space-y-2">
                        @forelse ($notifications as $notification)
                            <div class="group relative {{ $notification->read_at ? 'bg-transparent' : 'bg-gray-800/30' }} hover:bg-white/5 rounded-lg transition-all duration-150">
                                <div class="p-4">
                                    <div class="flex items-start gap-3">
                                        <!-- Icon -->
                                        <div class="flex-shrink-0 mt-0.5">
                                            @if ($notification->type === 'App\Notifications\NoteSharedNotification')
                                                <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-2 mb-1.5">
                                                <p class="text-sm text-gray-300 leading-relaxed">
                                                    @if ($notification->type === 'App\Notifications\NoteSharedNotification')
                                                        <span class="font-medium text-gray-100">{{ $notification->data['sharer'] }}</span> invited you to note: "<span class="font-medium text-gray-100">{{ $notification->data['note_title'] }}</span>" with <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-800 text-gray-400">{{ $notification->data['permission'] }}</span> permissions.
                                                        @php
                                                            $invitation = App\Models\NoteInvitation::where('token', $notification->data['token'])->first();
                                                        @endphp
                                                        @if ($invitation && !$invitation->accepted_at)
                                                            <!-- Invitation available -->
                                                        @else
                                                            <span class="text-gray-600 text-xs">(Invitation {{ $invitation ? 'accepted' : 'no longer valid' }})</span>
                                                        @endif
                                                    @else
                                                        {{ $notification->data['message'] ?? 'New notification' }}
                                                    @endif
                                                </p>
                                                @if (!$notification->read_at)
                                                    <div class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0 mt-1.5"></div>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-3 text-xs text-gray-600">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex items-center gap-2 mt-3">
                                                @if ($notification->type === 'App\Notifications\NoteSharedNotification')
                                                    @php
                                                        $invitation = App\Models\NoteInvitation::where('token', $notification->data['token'])->first();
                                                    @endphp
                                                    @if ($invitation && !$invitation->accepted_at)
                                                        <a href="{{ $notification->data['url'] }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-200 bg-gray-800 hover:bg-gray-700 px-3 py-1.5 rounded-md transition-colors">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            Accept Invitation
                                                        </a>
                                                    @endif
                                                @endif

                                                @if (!$notification->read_at)
                                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-xs text-gray-500 hover:text-gray-300 hover:bg-white/5 px-2.5 py-1.5 rounded-md transition-colors">
                                                            Mark as Read
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800/50 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm font-medium mb-1">All caught up!</p>
                                <p class="text-gray-600 text-xs">You have no notifications.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 pt-4 border-t border-gray-800/50">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>