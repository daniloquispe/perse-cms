<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
	#[Validate('required', message: 'Ingresa tu correo electrónico')]
	#[Validate('email', message: 'Ingresa un correo electrónico válido')]
	public string $email = '';

	#[Validate('required', message: 'Ingresa tu contraseña')]
	public string $password = '';

	public function login(): bool
	{
		$this->validate();

		$credentials = ['email' => $this->email, 'password' => $this->password];

		if (Auth::guard('storefront')->attempt($credentials))
		{
			session()->regenerate();

			return true;
		}

		return false;
	}
}
