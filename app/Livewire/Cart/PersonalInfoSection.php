<?php

namespace App\Livewire\Cart;

use App\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalInfoSection extends Component
{
	public string $email;

	public string $firstName;

	public string $lastName;

	public string $documentIdentityNumber;

	public string $phone;

	public int $invoiceType;

	public bool $showInvoiceFields;

	public string $ruc;

	public string $businessName;

	public function mount(): void
	{
		$this->invoiceType = 3;
		$this->showInvoiceFields = false;

		if (Auth::guard('storefront')->check())
		{
			$user = Auth::guard('storefront')->user();

			$this->email = $user->email;
			$this->firstName = $user->first_name;
			$this->lastName = $user->last_name;
			$this->documentIdentityNumber = $user->id_document_number;
			$this->phone = $user->phone;
		}
	}

    public function render()
    {
        return view('livewire.cart.personal-info-section');
    }

	public function toggleInvoiceFields(): void
	{
		$this->showInvoiceFields = $this->invoiceType == 1;
	}

	public function nextStep(): void
	{
		Cart::setStep(3);

		$this->redirectRoute('cart.delivery');
	}
}
