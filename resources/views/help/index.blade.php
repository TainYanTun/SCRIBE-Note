<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Help & Getting Started') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg="px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
                <h3 class="text-2xl font-bold mb-4">Welcome to Scribe!</h3>
                <p class="mb-6">Scribe is your personal note-taking application designed to help you organize your thoughts, ideas, and information efficiently. This guide will help you get started with its core features.</p>

                <div class="space-y-8">
                    <!-- Creating Notes -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">1. Creating Notes</h4>
                        <p class="mb-2">To create a new note, click on the "Create Note" button in the sidebar. You can give your note a title and start writing in the rich text editor. Scribe supports various formatting options to make your notes clear and organized. You can also link notes together by typing `[[Note Title]]` which will automatically create a link to an existing note or a new one if it doesn't exist.</p>
                        <p class="text-sm text-gray-400"><em>Tip: Use descriptive titles and link related notes to build a connected knowledge base.</em></p>
                    </div>

                    <!-- Organizing with Tags -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">2. Organizing with Tags</h4>
                        <p class="mb-2">Tags are keywords you can attach to your notes to categorize them. You can add multiple tags to a single note, making it easy to find related content across different folders. On the dashboard, you'll see your most used tags, and you can view all tags from the sidebar or dashboard.</p>
                        <p class="mb-2">Scribe also features <strong>Special Tags</strong> like 'favorite', 'important', and 'todo'. These tags can be toggled directly from the note actions in your notes list or dashboard, providing quick ways to mark and filter your notes based on their status or priority. These special tags help you quickly identify and manage your most crucial notes.</p>
                        <p class="text-sm text-gray-400"><em>Example: #project-x, #idea, #meeting-notes. Manage all your tags from the Tags section to keep them organized.</em></p>
                    </div>

                    <!-- Using Folders -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">3. Using Folders</h4>
                        <p class="mb-2">Folders provide a hierarchical way to organize your notes. You can create new folders, rename existing ones, and delete them from the "All Files" section in the sidebar. To move a note into a folder, simply edit the note and assign it to the desired folder. This helps in structuring your notes for larger projects or distinct categories.</p>
                        <p class="text-sm text-gray-400"><em>Folders are great for larger projects or distinct categories of notes.</em></p>
                    </div>

                    <!-- Graph View -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">4. Graph View</h4>
                        <p class="mb-2">The Graph View (accessible from the sidebar) visually represents the connections between your notes. Each box is a note, and lines show links. You can drag nodes to rearrange them, hover over them to see connected notes highlighted, and click on a node to navigate directly to that note's page. Use the tag filter at the top to narrow down the notes displayed in the graph, helping you focus on specific topics or projects.</p>
                        <p class="text-sm text-gray-400"><em>This is a powerful tool for discovering relationships and exploring your ideas visually.</em></p>
                    </div>

                    <!-- Sharing Notes -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">5. Sharing Notes</h4>
                        <p class="mb-2">Scribe allows you to collaborate by sharing your notes with other users. When sharing, you can choose between two permission levels: <strong>Read-Only</strong> (recipients can only view the note) or <strong>Edit</strong> (recipients can view and modify the note). To share a note, go to the note's page and look for the sharing options. Recipients will receive an invitation that they can accept to gain access to the shared note.</p>
                    </div>

                    <!-- Notifications -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">6. Notifications</h4>
                        <p class="mb-2">Stay updated with all activity related to your notes. You'll receive notifications when a note is shared with you, when someone comments on your shared notes, or other important updates. You can view all your notifications from the sidebar and mark them as read individually or all at once to keep your inbox clean.</p>
                    </div>

                    <!-- Profile Settings -->
                    <div>
                        <h4 class="text-xl font-semibold mb-2">7. Profile Settings</h4>
                        <p class="mb-2">Manage your Scribe account by accessing your Profile Settings. Here you can update your name, email address, change your password, and upload or change your profile photo. Keeping your profile updated helps personalize your Scribe experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
