<?php

namespace App\Livewire;

use App\Cart;
use Illuminate\View\View;
use Livewire\Component;

class CartIndicator extends Component
{
	public bool $show = false;

    public function render(): View
    {
		$count = Cart::getItemsCount();
		$items = Cart::getItems();
		$total = Cart::getTotal();

		$data = compact('count', 'items', 'total');
        return view('livewire.cart-indicator', $data);
    }
}
