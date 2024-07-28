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
			['id' => PageRole::Home->value, 'name' => 'Inicio', 'title' => 'Inicio'],
			['id' => PageRole::Contact->value, 'name' => 'Contacto', 'title' => 'Contáctenos'],
			['id' => PageRole::AboutUs->value, 'name' => 'Quiénes somos', 'title' => 'Quiénes somos'],
			['id' => PageRole::PrivacyPolitics->value, 'name' => 'Políticas de privacidad', 'title' => 'Políticas de privacidad'],
			['id' => PageRole::CookiesPolitics->value, 'name' => 'Políticas de cookies', 'title' => 'Políticas de cookies'],
			['id' => PageRole::DeliveryPolitics->value, 'name' => 'Políticas de envío', 'title' => 'Políticas de envío'],
			['id' => PageRole::ReturningPolitics->value, 'name' => 'Políticas de devoluciones', 'title' => 'Políticas de envío'],
			['id' => PageRole::ComplaintsBook->value, 'name' => 'Libro de reclamaciones', 'title' => 'Libro de reclamaciones'],
			['id' => PageRole::Terms->value, 'name' => 'Términos y condiciones', 'title' => 'Términos y condiciones'],
			['id' => PageRole::Login->value, 'name' => 'Iniciar sesión'],
			['id' => PageRole::Register->value, 'name' => 'Crear cuenta'],
			['id' => PageRole::PasswordRecovery->value, 'name' => 'Recuperar contraseña'],
		];

		foreach ($pagesData as $pageData)
			Page::create($pageData);
    }
}
