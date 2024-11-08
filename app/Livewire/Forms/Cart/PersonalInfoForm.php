<?php

namespace App\Livewire\Forms\Cart;

use App\Cart;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

/**
 * Cart personal info form.
 *
 * @todo Update invoice type validation rules (when ERP integration is set)
 */
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

	#[Validate('nullable')]
	public ?int $invoiceType = null;

	#[Validate('required_if:invoiceType,1', message: 'Por favor ingresa tu número de RUC')]
	public ?string $ruc = '';

	#[Validate('required_if:invoiceType,1', message: 'Por favor ingresa tu razón social')]
	public ?string $businessName = '';

	public function __construct(Component $component, $propertyName)
	{
		parent::__construct($component, $propertyName);

		$this->email = Cart::getEmail();
		$this->firstName = Cart::getFirstName();
		$this->lastName = Cart::getLastName();
		$this->identityDocumentNumber = Cart::getIdentityDocumentNumber();
		$this->phone = Cart::getPhone();
		$this->invoiceType = Cart::getInvoiceType()?->value;
		$this->ruc = Cart::getRuc();
		$this->businessName = Cart::getBusinessName();
	}

	public function submit(): bool
	{
		$this->validate();

		Cart::setPersonalInfo($this->email, $this->firstName, $this->lastName, $this->identityDocumentNumber, $this->phone, $this->invoiceType, $this->ruc, $this->businessName);

		return true;
	}
}
