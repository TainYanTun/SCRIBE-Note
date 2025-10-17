<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Str;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if ($user) {
            $notesData = [
                [
                    'title' => 'My First Note',
                    'content' => 'This is the content of my first note. It\'s about getting started with Laravel.',
                ],
                [
                    'title' => 'Eloquent Relationships',
                    'content' => 'Exploring different types of Eloquent relationships: one-to-one, one-to-many, many-to-many, and polymorphic.',
                ],
                [
                    'title' => 'Database Migrations',
                    'content' => 'Understanding how to create and run database migrations in Laravel for schema management.',
                ],
            ];

            foreach ($notesData as $noteData) {
                $user->notes()->create([
                    'title' => $noteData['title'],
                    'slug' => Str::slug($noteData['title']),
                    'content' => $noteData['content'],
                ]);
            }
        }
    }
}
