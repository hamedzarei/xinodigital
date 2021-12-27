<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();

         Post::factory(3)->create();
         $posts = Post::get();
         $url = 'https://source.unsplash.com/random/300x300';
         foreach ($posts as $post) {
             $post->addMediaFromUrl($url)
                 ->toMediaCollection('downloads');
         }
    }
}
