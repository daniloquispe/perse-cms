<?php

namespace Database\Factories;

use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
	use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'category_id' => BookCategory::query()->inRandomOrder()->value('id'),
			'sku' => $this->faker->randomNumber(6),
			'isbn' => $this->faker->isbn13(),
			'title' => $this->faker->sentence(),
			'year' => $this->faker->year(),
			'pages_count' => $this->faker->randomNumber(4),
			'weight' => $this->faker->randomFloat(max: 2),
			'width' => $this->faker->randomFloat(max: 30),
			'height' => $this->faker->randomFloat(max: 50),
			'price' => $this->faker->randomFloat(2, 5, 1000),
		];
    }
}
