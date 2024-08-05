<?php

namespace Database\Seeders;

use App\Models\MarqueeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarqueeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$itemsData = [
			['order' => 1, 'text' => 'Términos y condiciones Black Weekend 2024'],
			['order' => 2, 'text' => 'Regístrate ahora y obtén un descuento especial'],
			['order' => 3, 'text' => '¡Hacemos envíos a todo el Perú!'],
		];

		foreach ($itemsData as $itemData)
			MarqueeItem::create($itemData);
    }
}
