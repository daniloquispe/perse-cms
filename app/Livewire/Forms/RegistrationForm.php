<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegistrationForm extends Form
{
	#[Validate('required', message: "Debe ingresar el código de acceso que le enviamos a su correo electrónico")]
	public string $access_code = '';

	#[Validate('required', message: "Debe ingresar una contraseña")]
	public string $password = '';

	#[Validate('required', message: "Debe volver a ingresar su contraseña")]
	#[Validate('confirmed', message: "Las contraseñas no coinciden")]
	public string $password_confirmation = '';

	#[Validate('accepted', message: "Debe aceptar el tratamiento de sus datos")]
	public bool $accept = false;

	public function submit(string $email): Customer|null
	{
//		$this->validate();

		$data = [
			'email' => $email,
			'password' => bcrypt($this->password),
		];

		$user = new Customer($data);

		return $user->save() ? $user : null;
	}
}