<?php

namespace Database\Seeders;

use App\Models\BookFormat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookFormatSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$itemsData = [
			['order' => 1, 'name' => 'Libro Físico'],
		];

		foreach ($itemsData as $itemData)
			BookFormat::create($itemData);
	}
}
