<?php

namespace App\Livewire\Forms;

use App\Models\ComplaintSheet;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class ComplaintsBookForm extends Form
{
	#[Validate('nullable')]
	#[Validate('exists:Customer')]
	public ?int $customer_id = null;

	#[Validate('required', message: 'Ingrese su nombre completo')]
	public string $name = '';

	#[Validate('required', message: 'Ingrese su documento de identidad')]
	public string $id_document_number = '';

	#[Validate('required', message: 'Ingrese su dirección')]
	public string $address = '';

	#[Validate('string')]
	public string $phone = '';

	#[Validate('required', message: 'Ingrese su correo electrónico')]
	#[Validate('email', message: 'ingrese un correo electrónico válido')]
	public string $email = '';

	#[Validate('boolean')]
	public bool $is_service = false;

	#[Validate('decimal:10,2', message: 'Ingrese un monto válido')]
	public ?float $amount = null;

	#[Validate('required', message: 'Ingrese el detalle de su reclamo')]
	public string $detail = '';

	#[Validate('string')]
	public string $request = '';

	#[Validate('string')]
	public string $reply = '';

	public function __construct(Component $component, $propertyName)
	{
		parent::__construct($component, $propertyName);

		if (Auth::guard('storefront')->check())
		{
			$customer = Auth::guard('storefront')->user();

			$this->customer_id = $customer->id;
			$this->name = $customer->full_name;
			$this->id_document_number = $customer->id_document_number;
			$this->phone = $customer->phone;
			$this->email = $customer->email;
		}
	}

	public function submit(): bool
	{
		$result = ComplaintSheet::create($this->all());

		if ($result)
			$this->reset();

		return $result;
	}
}
