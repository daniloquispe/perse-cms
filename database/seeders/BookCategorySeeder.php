<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$categoriesData = [
			['order' => 1, 'name' => 'Comics y Mangas', 'is_visible' => true],
			['order' => 2, 'name' => 'Libros Infantiles', 'is_visible' => true],
			['order' => 3, 'name' => 'Libros Juveniles', 'is_visible' => true],
			['order' => 4, 'name' => 'Ficción', 'is_visible' => true],
			['order' => 5, 'name' => 'No Ficción', 'is_visible' => true],
			['order' => 6, 'name' => 'Bienestar y Salud', 'is_visible' => true],
			['order' => 7, 'name' => 'Empresa y Gestión', 'is_visible' => true],
		];

		foreach ($categoriesData as $categoryData)
		{
			$category = BookCategory::create($categoryData);

			if (app()->isLocal())
			{
				$childrenCount = rand(10, 25);

				BookCategory::factory($childrenCount)->create(['parent_id' => $category->id]);
			}
		}
    }
}
