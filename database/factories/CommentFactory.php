<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['user_id' => "int", 'comment' => "string", 'commentable_type' => "string"])]
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'comment' => $this->faker->sentence(),
            'commentable_type' => Comment::class,
        ];
    }
}
