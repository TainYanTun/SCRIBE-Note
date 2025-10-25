@props(['folders'])

@foreach ($folders as $folder)
    <li>
        <a href="{{ route('folders.index', ['folder' => $folder->id]) }}" class="flex items-center px-2 py-1.5 text-sm text-gray-300 hover:bg-white/5 rounded-md transition-colors duration-150 group w-full">
            <svg class="w-4 h-4 mr-3 text-gray-500 group-hover:text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
            </svg>
            <span class="truncate">{{ $folder->name }}</span>
        </a>
        @if ($folder->children->count() > 0)
            <ul class="ml-4 space-y-0.5">
                <x-folder-list :folders="$folder->children" />
            </ul>
        @endif
    </li>
@endforeach
