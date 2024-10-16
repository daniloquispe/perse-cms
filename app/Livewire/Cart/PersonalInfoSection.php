<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Livewire\Forms\Cart\PersonalInfoForm;
use App\Toast;
use Livewire\Component;

class PersonalInfoSection extends Component
{
	use Toast;

	public PersonalInfoForm $form;

	public bool $showInvoiceFields = false;

    /*public function render()
    {
        return view('livewire.cart.personal-info-section');
    }*/

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
