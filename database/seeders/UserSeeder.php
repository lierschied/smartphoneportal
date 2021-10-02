<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Smartphone;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(15)->create();
        foreach (User::where('id', '!=', null)->inRandomOrder()->get() as $user) {
            foreach (Smartphone::where('id', '>', 378)->where('id', '<', 403)->get() as $smartphone) {
                Comment::factory()->createOne(['user_id' => $user->id, 'commentable_id' => $smartphone->id, 'commentable_type' => Smartphone::class]);
                Rating::factory()->createOne(['user_id' => $user->id, 'smartphone_id' => $smartphone->id]);
            }
        }

        foreach (Comment::all() as $comment) {
            foreach (User::where('id', '!=', $comment->user_id)->limit(5)->inRandomOrder()->get() as $user) {
                Like::factory()->createOne(['user_id' => $user->id, 'comment_id' => $comment->id]);
            }
        }
    }
}
