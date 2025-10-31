<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Help & Getting Started') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#252525] overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
                <h3 class="text-2xl font-bold mb-4">Welcome to Scribe!</h3>
                <p class="mb-6">Scribe is your personal note-taking application designed to help you organize your thoughts, ideas, and information efficiently. This guide will help you get started with its core features.</p>

                <div class="space-y-8">
                    <!-- Creating Notes -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">1. Creating Notes</h4>
                        <p class="mb-2">To create a new note, click on the "Create Note" button in the sidebar. You can give your note a title and start writing. Notes are the fundamental building blocks of your knowledge base.</p>
                        <p class="text-sm text-gray-400"><em>Tip: Keep your note titles descriptive for easy searching later.</em></p>
                    </div>

                    <!-- Organizing with Tags -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">2. Organizing with Tags</h4>
                        <p class="mb-2">Tags help you categorize and find your notes quickly. You can add multiple tags to a single note. On the dashboard, you'll see your most used tags, and you can view all tags from the sidebar or dashboard.</p>
                        <p class="text-sm text-gray-400"><em>Example: #project-x, #idea, #meeting-notes</em></p>
                    </div>

                    <!-- Using Folders -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">3. Using Folders</h4>
                        <p class="mb-2">Folders provide another layer of organization, allowing you to group related notes together. You can create, rename, and delete folders from the "All Files" section in the sidebar.</p>
                        <p class="text-sm text-gray-400"><em>Folders are great for larger projects or distinct categories of notes.</em></p>
                    </div>

                    <!-- Graph View -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">4. Graph View</h4>
                        <p class="mb-2">The Graph View (accessible from the sidebar) visually represents the connections between your notes. Each box is a note, and lines show links. You can drag nodes to rearrange them, hover over them to see connected notes, and click on a node to navigate directly to that note.</p>
                        <p class="text-sm text-gray-400"><em>This is a powerful tool for discovering relationships between your ideas.</em></p>
                    </div>

                    <!-- Sharing Notes -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">5. Sharing Notes</h4>
                        <p class="mb-2">Scribe allows you to share your notes with other users. You can set different permission levels (read-only, edit) when sharing. Look for sharing options within individual note pages.</p>
                    </div>

                    <!-- Notifications -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">6. Notifications</h4>
                        <p class="mb-2">Stay updated with activity related to your notes, such as when a note is shared with you. You can view all your notifications from the sidebar.</p>
                    </div>

                    <!-- Profile Settings -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">7. Profile Settings</h4>
                        <p class="mb-2">Manage your account details, including your profile picture and other personal information, in the Profile Settings section.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
