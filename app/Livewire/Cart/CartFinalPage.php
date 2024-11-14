<?php

namespace App\Livewire\Cart;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CartFinalPage extends Component
{
	#[Layout('components.layouts.cart')]
    public function render(): View
    {
		if (!Session::has('orderEmail'))
			$this->redirectRoute('home');

        return view('livewire.cart.cart-final-page')
			->title('¡Gracias por la compra! :: ' . config('app.name'));
    }
}
