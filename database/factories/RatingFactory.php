<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['user_id' => "int", 'smartphone_id' => "int", 'stars' => "string"])]
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'stars' => (string) $this->faker->numberBetween(0, 5),
        ];
    }
}
