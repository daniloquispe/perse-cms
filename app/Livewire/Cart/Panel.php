<?php

namespace App\Livewire\Cart;

use App\Cart;
use Livewire\Component;

class Panel extends Component
{
	public int $step;

	public function mount(): void
	{
		$this->step = Cart::getStep();
	}

    public function render()
    {
        return view('livewire.cart.panel');
    }
}
