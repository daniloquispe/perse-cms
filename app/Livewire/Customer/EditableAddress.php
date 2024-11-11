<?php

namespace App\Livewire\Customer;

use App\Livewire\Forms\Customer\AddressForm;
use App\Models\Address;
use App\Services\UbigeoService;
use App\Toast;
use Livewire\Component;

class EditableAddress extends Component
{
	use Toast;

	public AddressForm $form;

	public Address $address;

	public array $departments;

	public array $provinces;

	public array $districts;

	public bool $showEditForm;

	public function mount(UbigeoService $ubigeoService): void
	{
		$this->departments = $ubigeoService->loadDepartments();
		$this->provinces = $ubigeoService->loadProvinces($this->address->department_id);
		$this->districts = $ubigeoService->loadDistricts($this->address->province_id);

		$this->form->loadData($this->address);

		$this->showEditForm = false;
	}

	/*public function render()
    {
        return view('livewire.customer.editable-address');
    }*/

	public function toggleEditForm(): void
	{
		$this->showEditForm = !$this->showEditForm;
	}

	public function loadProvinces(UbigeoService $ubigeoService): void
	{
		$this->provinces = $ubigeoService->loadProvinces($this->form->departmentId);
		$this->districts = [];
	}

	public function loadDistricts(UbigeoService $ubigeoService): void
	{
		$this->districts = $ubigeoService->loadDistricts($this->form->provinceId);
	}

	public function submit(UbigeoService $ubigeoService): void
	{
		if ($this->form->submit($ubigeoService, $this->address))
		{
			$this->toast('Dirección actualizada');
			$this->showEditForm = false;
		}
		else
			$this->toast('No se pudo actualizar la dirección', 'Por favor, intenta nuevamente');
	}
}
