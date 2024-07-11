<?php

namespace Database\Seeders;

use App\Models\Page;
use App\PageRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$pagesData = [
			['id' => PageRole::Home->value, 'name' => 'Inicio', 'title' => 'Inicio', 'description' => 'Persé Librerías'],
			['id' => PageRole::Contact->value, 'name' => 'Contacto', 'title' => 'Contáctenos', 'description' => 'Contacto con Persé Librerías'],
			['id' => PageRole::AboutUs->value, 'name' => 'Quiénes somos', 'title' => 'Quiénes somos', 'description' => 'Acerca de Persé Librerías'],
			['id' => PageRole::PrivacyPolitics->value, 'name' => 'Políticas de privacidad', 'title' => 'Políticas de privacidad', 'description' => 'Políticas de privacidad'],
			['id' => PageRole::CookiesPolitics->value, 'name' => 'Políticas de cookies', 'title' => 'Políticas de cookies', 'description' => 'Políticas de cookies'],
			['id' => PageRole::DeliveryPolitics->value, 'name' => 'Políticas de envío', 'title' => 'Políticas de envío', 'description' => 'Políticas de envío'],
			['id' => PageRole::ReturningPolitics->value, 'name' => 'Políticas de devoluciones', 'title' => 'Políticas de envío', 'description' => 'Políticas de devoluciones'],
			['id' => PageRole::ComplaintsBook->value, 'name' => 'Libro de reclamaciones', 'title' => 'Libro de reclamaciones', 'description' => 'Libro de reclamaciones'],
			['id' => PageRole::Terms->value, 'name' => 'Términos y condiciones', 'title' => 'Términos y condiciones', 'description' => 'Términos y condiciones'],
		];

		foreach ($pagesData as $pageData)
			Page::create($pageData);
    }
}
