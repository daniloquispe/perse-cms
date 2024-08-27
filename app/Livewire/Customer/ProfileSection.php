<?php

namespace App\Livewire\Customer;

use App\Livewire\Forms\Customer\ProfileForm;
use App\Toast;
use Illuminate\View\View;
use Livewire\Component;

class ProfileSection extends Component
{
	use Toast;

	public bool $isEditable;

	public ProfileForm $form;

    public function render(): View
    {
        return view('livewire.customer.profile-section');
    }

	public function saveForm(): void
	{
		if (!$this->isEditable)
			return;

		if ($this->form->save())
		{
			$this->toast('Se actualizó tu perfil');
			$this->isEditable = false;
		}
		else
			$this->toast('No se pudo actualizar tu perfil', 'Por favor, inténtalo de nuevo');
	}

	public function makeEditable(): void
	{
		$this->isEditable = true;
	}
}
