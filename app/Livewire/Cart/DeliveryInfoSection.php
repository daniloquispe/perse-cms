<?php

namespace App\Livewire\Cart;

use App\Cart;
//use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\Cart\DeliveryInfoForm;
use App\Toast;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class DeliveryInfoSection extends Component
{
	use Toast;

//	public string $email;

//	public string $firstName;

//	public string $lastName;

//	public string $documentIdentityNumber;

//	public string $phone;

//	public bool $withSubscription;

//	public bool $withInvoice;

//	public bool $showInvoiceFields;

//	public string $ruc;

//	public string $businessName;

	public DeliveryInfoForm $form;

	public array $departments;

	public array $provinces;

	public array $districts;

	public bool $isDeliveryDateFieldVisible = false;

	public function mount(): void
	{
		/*$this->showInvoiceFields = false;
		$this->showAddressForm = false;

		if (Auth::guard('storefront')->check())
		{
			$user = Auth::guard('storefront')->user();

			$this->email = $user->email;
			$this->firstName = $user->first_name;
			$this->lastName = $user->last_name;
			$this->documentIdentityNumber = $user->id_document_number;
			$this->phone = $user->phone;
		}*/

		$this->loadDepartments();
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
	}

	public function loadDistricts(): void
	{
		if (!isset($this->form->provinceId))
			return;

		$response = Http::get('https://adminisol.isolperu.com/api/districts/' . $this->form->provinceId);
		$responseBody = $response->body();

		$this->districts = json_decode($responseBody, true);
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
		if ($this->form->submit())
		{
			Cart::setStep(4);

			$this->redirectRoute('cart.payment');
		}
		else
			$this->toast('No se puede continuar al siguiente paso', 'Por favor, inténtalo de nuevo');
	}
}
