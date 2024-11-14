<?php

namespace App\Livewire\Forms\Customer;

use App\Models\Address;
use App\Services\UbigeoService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AddressForm extends Form
{
	#[Validate('required', message: 'Selecciona un departamento')]
	public int $departmentId;

	#[Validate('required', message: 'Selecciona una provincia')]
	public int $provinceId;

	#[Validate('required', message: 'Selecciona un distrito')]
	public int $districtId;

	#[Validate('required', message: 'Escribe tu dirección')]
	public string $address;

	#[Validate('required', message: 'Escribe el número')]
	public string $locationNumber;

	#[Validate('nullable')]
	public string|null $reference;

	public function loadData(Address $address): void
	{
		$this->departmentId = $address->department_id;
		$this->provinceId = $address->province_id;
		$this->districtId = $address->district_id;
		$this->address = $address->address;
		$this->locationNumber = $address->location_number;
		$this->reference = $address->reference;
	}

	public function submit(UbigeoService $ubigeoService, Address $address): bool
	{
		$this->validate();

		$address->department_id = $this->departmentId;
		$address->province_id = $this->provinceId;
		$address->district_id = $this->districtId;
		$address->address = $this->address;
		$address->location_number = $this->locationNumber;
		$address->reference = $this->reference;

		$address->department_name = $ubigeoService->getDepartment($this->departmentId)['name'];
		$address->province_name = $ubigeoService->getProvince($this->provinceId)['name'];
		$address->district_name = $ubigeoService->getDistrict($this->districtId)['name'];

		return $address->save();
	}
}
