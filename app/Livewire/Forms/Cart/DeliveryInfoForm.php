<?php

namespace App\Livewire\Forms\Cart;

use App\Cart;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DeliveryInfoForm extends Form
{
	#[Validate('required', message: 'Seleccione un departamento')]
	public int $departmentId;

	#[Validate('required', message: 'Seleccione una provincia')]
	public int $provinceId;

	#[Validate('required', message: 'Seleccione un distrito')]
	public int $districtId;

	#[Validate('required', message: 'Ingrese una dirección')]
	public string $address;

	#[Validate('required', message: 'Ingrese un número de dirección')]
	public string $locationNumber;

	#[Validate('string')]
	public string|null $reference;

	#[Validate('string')]
	public string|null $recipientName;

	#[Validate('required', message: 'Seleccione una fecha de entrega')]
	#[Validate('date', message: 'Seleccione una fecha válida')]
	public string|null $deliveryDate = null;

	public function submit(): bool
	{
		$this->validate();

		Cart::setDeliveryInfo($this->departmentId, $this->provinceId, $this->districtId, $this->address, $this->locationNumber, $this->reference, $this->recipientName, $this->deliveryDate);

		return true;
	}
}