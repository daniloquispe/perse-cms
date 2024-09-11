<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Livewire\Forms\Cart\PersonalInfoForm;
use App\Toast;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalInfoSection extends Component
{
	use Toast;

	public PersonalInfoForm $form;

	public bool $showInvoiceFields;

	public function mount(): void
	{
		$this->form->invoiceType = 3;
		$this->showInvoiceFields = false;

		if (Auth::guard('storefront')->check())
		{
			$user = Auth::guard('storefront')->user();

			$this->form->email = $user->email;
			$this->form->firstName = $user->first_name;
			$this->form->lastName = $user->last_name;
			$this->form->identityDocumentNumber = $user->id_document_number;
			$this->form->phone = $user->phone;
		}
	}

    public function render()
    {
        return view('livewire.cart.personal-info-section');
    }

	public function toggleInvoiceFields(): void
	{
		$this->showInvoiceFields = $this->form->invoiceType == 1;
	}

	public function submitForm(): void
	{
		if ($this->form->submit())
		{
			Cart::setStep(3);

			$this->redirectRoute('cart.delivery');
		}
		else
			$this->toast('No se puede continuar al siguiente paso', 'Por favor, inténtalo de nuevo');
	}
}
