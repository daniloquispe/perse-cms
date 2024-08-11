<?php

namespace Database\Seeders;

use App\Models\BookbindingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookbindingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$itemsData = [
			['order' => 1, 'name' => 'Tapa dura'],
			['order' => 2, 'name' => 'Tapa blanda'],
			['order' => 3, 'name' => 'Rústica'],
			['order' => 4, 'name' => 'Otros'],
		];

		foreach ($itemsData as $itemData)
			BookbindingType::create($itemData);
    }
}
