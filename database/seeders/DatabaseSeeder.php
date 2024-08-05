<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Danilo Quispe',
            'email' => 'dql@daniloquispe.dev',
			'password' => bcrypt('123456'),
			'is_customer' => false,
        ]);

		$this->call([
			MarqueeItemSeeder::class,
			SocialLinkSeeder::class,
			PageSeeder::class,
			AuthorSeeder::class,
			BookCategorySeeder::class,
			BookSeeder::class,
		]);
    }
}
