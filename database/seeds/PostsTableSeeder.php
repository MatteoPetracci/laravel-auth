<?php

use Illuminate\Database\Seeder;
Use App\User;
use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            // Instanzio un nuovo post
            $newPost = new Post;
            // Prendo l'id di questo utente
            $newPost->user_id = 1;
            $newPost->image = "https://picsum.photos/id/" . rand(1,100) . '/300/200';
            $newPost->title = $faker->text(10);
            $newPost->body = $faker->paragraph();
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->save();
        }
    }
}
