<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum PageRole: int implements HasLabel
{
	case Home = 1;
	case Contact = 2;
	case AboutUs = 3;
	case ComplaintsBook = 4;
	case PrivacyPolicy = 5;
	case CookiesPolicy = 6;
	case DeliveryPolicy = 7;
	case ReturningPolicy = 8;
	case Terms = 9;
	case Login = 10;
	case Register = 11;
	case PasswordRecovery = 12;
	case Subscribe = 13;
	case Unsubscribe = 14;

	public function getLabel(): ?string
	{
		return match ($this)
		{
			self::Home => 'Inicio',
			self::Contact => 'Contacto',
			self::AboutUs => 'Quiénes somos',
			self::ComplaintsBook => 'Libro de reclamaciones',
			self::PrivacyPolicy => 'Política de privacidad',
			self::CookiesPolicy => 'Política de cookies',
			self::DeliveryPolicy => 'Política de entrega',
			self::ReturningPolicy => 'Política de devoluciones',
			self::Terms => 'Términos y condiciones',
			self::Login => 'Iniciar sesión',
			self::Register => 'Registro',
			self::PasswordRecovery => 'Recuperar contraseña',
			self::Subscribe => 'Suscripción',
			self::Unsubscribe => 'Desuscripción',
		};
	}
}
