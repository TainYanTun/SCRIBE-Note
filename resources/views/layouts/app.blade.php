<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- EasyMDE CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[#191919]">
            

            <div class="flex h-screen">
                <aside class="w-1/8 bg-[#191919] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent border-r border-gray-800/50">
                    @include('layouts.sidebar')
                </aside>

                <div class="w-7/8 flex flex-col">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-[#191919] shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-100">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main class="flex-grow p-6 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
        <style>
            /* Custom scrollbar for Notion-like appearance */
            .scrollbar-thin::-webkit-scrollbar {
                width: 6px;
            }
            .scrollbar-thin::-webkit-scrollbar-track {
                background: transparent;
            }
            .scrollbar-thin::-webkit-scrollbar-thumb {
                background: #3f3f3f;
                border-radius: 3px;
            }
            .scrollbar-thin::-webkit-scrollbar-thumb:hover {
                background: #4f4f4f;
            }
        </style>
        <!-- EasyMDE JS -->
        <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
        <!-- Marked.js -->
        <script src="https://cdn.jsdelivr.net/npm/marked/lib/marked.umd.js"></script>
    </body>
</html>
