<?php

namespace App\Livewire\Customer;

use Illuminate\View\View;
use Livewire\Component;

class CustomerPage extends Component
{
	public $breadcrumbs;

	public function mount(): void
	{
		// Breadcrumbs
		$this->breadcrumbs = [['text' => 'Perfil', 'url' => null]];
	}

	public function render(): View
    {
        return view('livewire.customer.page')
			->title('Mi perfil :: ' . config('app.name'));
    }
}
