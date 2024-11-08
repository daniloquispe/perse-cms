<?php

namespace App\Livewire\Customer;

use App\Cart;
use App\Models\Order;
use Livewire\Component;

class OrderSection extends Component
{
	public Order $order;

	/*public function render()
    {
		return view('livewire.customer.order-section');
    }*/

	public function repeat(): void
	{
		foreach ($this->order->items as $item)
			Cart::add($item->book, $item->quantity);

		$this->redirectRoute('cart.list');
	}
}
