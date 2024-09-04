<?php

namespace App\Livewire\Cart;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DeliveryInformationSection extends Component
{
	public bool $showAddressForm;

	public string $email;

	public string $firstName;

	public string $lastName;

	public string $documentIdentityNumber;

	public string $phone;

	public bool $withSubscription;

	public bool $withInvoice;

	public bool $showInvoiceFields;

	public string $ruc;

	public string $businessName;

	public array $departments;

	public int $departmentId;

	public array $provinces;

	public int $provinceId;

	public array $districts;

	public int $districtId;

	public function mount(): void
	{
		$this->showInvoiceFields = false;
		$this->showAddressForm = false;

		if (Auth::guard('storefront')->check())
		{
			$user = Auth::guard('storefront')->user();

			$this->email = $user->email;
			$this->firstName = $user->first_name;
			$this->lastName = $user->last_name;
			$this->documentIdentityNumber = $user->id_document_number;
			$this->phone = $user->phone;
		}

		$this->loadDepartments();
	}

    public function render()
    {
        return view('livewire.cart.delivery-information-section');
    }

	public function toggleInvoiceFields(): void
	{
		$this->showInvoiceFields = !$this->showInvoiceFields;
	}

	public function toggleAddressForm(): void
	{
		$this->showAddressForm = true;
	}

	public function loadDepartments(): void
	{
		$response = Http::get('https://adminisol.isolperu.com/api/departments');
		$responseBody = $response->body();

		$this->departments = json_decode($responseBody, true);
	}

	public function loadProvinces(): void
	{
		if (!isset($this->departmentId))
			return;

		$response = Http::get('https://adminisol.isolperu.com/api/provinces/' . $this->departmentId);
		$responseBody = $response->body();

		$this->provinces = json_decode($responseBody, true);
	}

	public function loadDistricts(): void
	{
		if (!isset($this->provinceId))
			return;

		$response = Http::get('https://adminisol.isolperu.com/api/districts/' . $this->provinceId);
		$responseBody = $response->body();

		$this->districts = json_decode($responseBody, true);
	}
}
