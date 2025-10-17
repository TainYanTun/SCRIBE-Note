<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = Note::all();

        if ($notes->count() >= 2) {
            // Link the first note to the second
            $notes[0]->linkedNotes()->attach($notes[1]->id);

            if ($notes->count() >= 3) {
                // Link the second note to the third
                $notes[1]->linkedNotes()->attach($notes[2]->id);
            }
        }
    }
}
