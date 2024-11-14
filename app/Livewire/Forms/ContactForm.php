<?php

namespace App\Livewire\Forms;

use App\Notifications\NewContactMessage;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
	#[Validate('required', message: 'Ingresa tu nombre')]
	public string $name = '';

	#[Validate('required', message: 'Ingresa tu correo electrónico')]
	public string $email = '';

	#[Validate('required', message: 'Ingresa tu teléfono')]
	public string $phone;

	#[Validate('required', message: 'Ingresa tu mensaje')]
	public string $message = '';

	#[Validate('accepted', message: 'Debes autorizar el tratamiento de tus datos')]
	public bool $acceptData = false;

	#[Validate('accepted', message: 'Debes autorizar el tratamiento de tus datos')]
	public bool $acceptAds = false;

	public function submit(): bool
	{
		$this->validate();

		Notification::route('mail', 'ventas@perselibrerias.com.pe')
			->notify(new NewContactMessage($this->name, $this->email, $this->phone, $this->message));

		return true;
	}
}
