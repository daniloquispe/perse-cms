<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Livewire\Forms\Cart\DeliveryInfoForm;
use App\Models\Address;
use App\Toast;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DeliveryInfoSection extends Component
{
	use Toast;

	public DeliveryInfoForm $form;

	public array $departments;

	public array $provinces;

	public bool $cannotSelectProvince;

	public array $districts;

	public bool $cannotSelectDistrict;

	public Address|null $lastAddress = null;

	public bool $isDeliveryDateFieldVisible = false;

	public int|null $deliveryPrice;

	#[Computed]
	public function minDeliveryDate(): string
	{
		$referenceDate = Carbon::today();

		$daysToAdd = match ($referenceDate->dayOfWeek)
		{
			5 => 5,  // Friday
			6 => 4,  // Saturday
			default => 3  // Other day
		};

		$referenceDate->addDays($daysToAdd);

		return $referenceDate->toDateString();
	}

	public function mount(): void
	{
		$this->loadDepartments();
		$this->loadProvinces();
		$this->loadDistricts();

		$this->loadLastAddress();

		$this->deliveryPrice = Cart::getDeliveryPrice();
	}

    public function render(): View
    {
		$email = Cart::getEmail();
		$firstName = Cart::getFirstName();
		$lastName = Cart::getLastName();
		$identityDocumentNumber = Cart::getIdentityDocumentNumber();
		$phone = Cart::getPhone();
		$invoiceType = Cart::getInvoiceType();
		$ruc = Cart::getRuc();
		$businessName = Cart::getBusinessName();

		$data = compact('email', 'firstName', 'lastName', 'identityDocumentNumber', 'phone', 'invoiceType', 'ruc', 'businessName');
        return view('livewire.cart.delivery-info-section', $data);
    }

	public function showAddressFields(): void
	{
		$this->lastAddress = null;
	}

	public function loadDepartments(): void
	{
		$response = Http::get('https://adminisol.isolperu.com/api/departments');
		$responseBody = $response->body();

		$this->departments = json_decode($responseBody, true);
	}

	public function loadProvinces(): void
	{
		if (!isset($this->form->departmentId))
			return;

		$response = Http::get('https://adminisol.isolperu.com/api/provinces/' . $this->form->departmentId);
		$responseBody = $response->body();

		$this->provinces = json_decode($responseBody, true);
		$this->cannotSelectProvince = count($this->provinces) == 0;
	}

	public function loadDistricts(): void
	{
		if (!isset($this->form->provinceId))
			return;

		$response = Http::get('https://adminisol.isolperu.com/api/districts/' . $this->form->provinceId);
		$responseBody = $response->body();

		$this->districts = json_decode($responseBody, true);
		$this->cannotSelectDistrict = count($this->districts) == 0;
	}

	private function loadLastAddress(): void
	{
		$lastAddress = Auth::guard('storefront')->user()->addresses()->latest()->first();

		if ($lastAddress)
		{
			$this->lastAddress = $lastAddress;
			$this->form->addressId = $lastAddress->id;
		}
	}

	public function calculateDeliveryPrice(): void
	{
		$deliveryPrice = $this->form->departmentId == 15  // Lima?
			? 7
			: 16;

		Cart::setDeliveryPrice($deliveryPrice);

		$this->dispatch('cart_updated');
	}

	public function showDeliveryDateField(): void
	{
		$this->isDeliveryDateFieldVisible = true;
	}

	public function hideDeliveryDateField(): void
	{
		$this->isDeliveryDateFieldVisible = false;
	}

	public function goToPersonalInfo(): void
	{
		Cart::setStep(2);

		$this->redirectRoute('cart.personal-info');
	}

	public function submitForm(): void
	{
		if ($this->lastAddress)
		{
			$this->form->addressId = $this->lastAddress->id;
			$this->form->departmentId = $this->lastAddress->department_id;
			$this->form->provinceId = $this->lastAddress->province_id;
			$this->form->districtId = $this->lastAddress->district_id;
			$this->form->address = $this->lastAddress->address;
			$this->form->locationNumber = $this->lastAddress->location_number;
			$this->form->reference = $this->lastAddress->reference;

			$this->calculateDeliveryPrice();
		}

		if ($this->form->submit())
		{
			Cart::setStep(4);

			$this->redirectRoute('cart.payment');
		}
		else
			$this->toast('No se puede continuar al siguiente paso', 'Por favor, inténtalo de nuevo');
	}
}
