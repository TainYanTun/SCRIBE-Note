<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Your Notifications</h3>

                    @forelse ($notifications as $notification)
                        <div class="border-b border-gray-200 py-4">
                            <p class="text-sm text-gray-600">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                            <p class="text-base text-gray-800">
                                @if ($notification->type === 'App\Notifications\NoteSharedNotification')
                                    {{ $notification->data['sharer'] }} invited you to note: "{{ $notification->data['note_title'] }}" with {{ $notification->data['permission'] }} permissions.
                                    <a href="{{ $notification->data['url'] }}" class="text-indigo-600 hover:text-indigo-900">Accept Invitation</a>
                                @else
                                    {{ $notification->data['message'] ?? 'New notification' }}
                                @endif
                            </p>
                            @if ($notification->read_at)
                                <span class="text-xs text-gray-500">Read</span>
                            @else
                                <span class="text-xs text-indigo-600">Unread</span>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-600">You have no new notifications.</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>