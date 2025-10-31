<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class CreateSpecialTagsForNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        $specialTags = [
            [
                'name' => 'favorite',
                'description' => 'Favorite notes',
            ],
            [
                'name' => 'important',
                'description' => 'Important notes',
            ],
            [
                'name' => 'todo',
                'description' => 'To-do items',
            ],
        ];

        foreach ($specialTags as $tag) {
            $user->tags()->create([
                'name' => $tag['name'],
                'slug' => Str::slug($tag['name']),
                'description' => $tag['description'],
            ]);
        }
    }
}
