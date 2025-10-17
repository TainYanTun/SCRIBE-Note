<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Tag;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = Note::all();
        $tags = Tag::all();

        if ($notes->isNotEmpty() && $tags->isNotEmpty()) {
            // Attach a few tags to each note
            foreach ($notes as $note) {
                // Get a random subset of tags (e.g., 1 to 3 tags)
                $randomTags = $tags->random(rand(1, min(3, $tags->count())));
                $note->tags()->attach($randomTags->pluck('id'));
            }
        }
    }
}
