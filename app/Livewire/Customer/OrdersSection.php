<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdersSection extends Component
{
	public Collection $orders;

	public function mount(): void
	{
		$this->orders = Order::query()
			->where('customer_id', Auth::guard('storefront')->id())
			->with('items')
			->latest()
			->get();
	}

    public function render()
    {
        return view('livewire.customer.orders-section');
    }
}
