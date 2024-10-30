<?php

namespace App\Livewire\Forms;

use App\Mail\CustomerRegistered;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegistrationForm extends Form
{
	#[Validate('required', message: "Debe ingresar el código de acceso que le enviamos a su correo electrónico")]
	public string $access_code = '';

	#[Validate('required', message: "Debe ingresar una contraseña")]
	#[Validate('min:6', message: "La contraseña debe tener como mínimo 6 caracteres")]
	#[Validate('confirmed', message: "Las contraseñas no coinciden")]
	public string $password = '';

	#[Validate('required', message: "Debe volver a ingresar su contraseña")]
	public string $password_confirmation = '';

	#[Validate('accepted', message: "Debe aceptar el tratamiento de sus datos")]
	public bool $accept = false;

	public function submit(string $email): Customer|null
	{
		$this->validate();

		$data = [
			'email' => $email,
			'password' => bcrypt($this->password),
		];

		$user = new Customer($data);

		Mail::to($email)->send(new CustomerRegistered($user));

		return $user->save() ? $user : null;
	}
}
