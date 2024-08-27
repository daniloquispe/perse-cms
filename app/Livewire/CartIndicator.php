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

		$data = compact('count');
        return view('livewire.cart-indicator', $data);
    }
}
