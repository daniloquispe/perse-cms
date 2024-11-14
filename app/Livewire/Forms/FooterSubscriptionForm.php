<?php

namespace App\Livewire\Forms;

use App\Models\Subscriber;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FooterSubscriptionForm extends Form
{
	#[Validate('required', message: 'Ingresa tu e-mail')]
	#[Validate('email', message: 'Ingresa un e-mail válido')]
	public string $email = '';

	#[Validate('accepted', message: 'Debes aceptar los términos del sitio y la política de seguridad')]
	public bool $acceptance = false;

	public function submit(): bool
	{
		$this->validate();

		$subscriber = new Subscriber();
		$subscriber->email = $this->email;

		return $subscriber->save();
	}
}
