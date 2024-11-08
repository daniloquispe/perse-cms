<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\View\View;
use Livewire\Component;

class CustomerOrderPage extends Component
{
	public $breadcrumbs;

	public Order|null $order;

	public function mount(Order $order = null): void
	{
		// Breadcrumbs
		$this->breadcrumbs = [['text' => 'Perfil', 'url' => null]];

		// Selected order (for order details page)
		$this->order = $order;
	}

	public function render(): View
    {
		return view('livewire.customer.page')
			->title('Mi perfil :: ' . config('app.name'));
    }
}
