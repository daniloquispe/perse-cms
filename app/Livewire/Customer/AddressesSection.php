<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class AddressesSection extends Component
{
	public int|null $addressIdToEdit = null;

    /*public function render()
    {
        return view('livewire.customer.addresses-section');
    }*/

	public function showEditForm(int $addressId): void
	{
		$this->addressIdToEdit = $this->addressIdToEdit == $addressId
			? null
			: $addressId;
	}

	public function submitEditForm(): void
	{
		;
	}
}
