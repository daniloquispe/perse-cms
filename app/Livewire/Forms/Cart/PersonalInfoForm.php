<?php

namespace App\Livewire\Forms\Cart;

use App\Cart;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonalInfoForm extends Form
{
	#[Validate('required', message: 'Por favor ingresa un correo electrónico')]
	#[Validate('email', message: 'Por favor ingresa un correo electrónico válido')]
	public string $email;

	#[Validate('required', message: 'Por favor ingresa tus nombres')]
	public string $firstName;

	#[Validate('required', message: 'Por favor ingresa tus apellidos')]
	public string $lastName;

	#[Validate('required', message: 'Por favor ingresa tu número de documento de identidad')]
	public string $identityDocumentNumber;

	#[Validate('required', message: 'Por favor ingresa tu teléfono')]
	public string $phone;

	#[Validate('required', message: 'Por favor selecciona un tipo de comprobante de pago')]
	public int $invoiceType;

	#[Validate('required_if:invoiceType,1', message: 'Por favor ingresa tu número de RUC')]
	public string $ruc = '';

	#[Validate('required_if:invoiceType,1', message: 'Por favor ingresa tu razón social')]
	public string $businessName = '';

	public function submit(): bool
	{
		$this->validate();

		Cart::setPersonalInfo($this->email, $this->firstName, $this->lastName, $this->identityDocumentNumber, $this->phone, $this->invoiceType, $this->ruc, $this->businessName);

		return true;
	}
}
