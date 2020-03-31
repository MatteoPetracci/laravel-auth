<?php
use App\Post;
use App\Comment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $count = count(Post::all()->toArray()) - 1;
        $posts = Post::all();

        foreach ($posts as $post) {
            for ($i=0; $i < 5; $i++) { 

                // Instanzio un nuovo Comment
                $newComment = new Comment;
                // Prendo l'id di questo utente
                $newComment->post_id = $post->id;
                $newComment->name = $faker->name;
                $newComment->email = $faker->email;
                $newComment->body = $faker->paragraph();
                $newComment->save();
            }
        }

        
    }
}
