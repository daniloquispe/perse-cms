<?php

namespace App\Livewire\Cart;

use App\Cart;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CartPage extends Component
{
	public int $step;

	public function mount(): void
	{
		$this->step = Cart::getStep();
	}

    #[Layout('components.layouts.cart')]
	public function render(): View
    {
		$title = match ($this->step)
		{
			1 => 'Mi Carrito de Compras',
			2 => 'Datos Personales',
			3 => 'Información de Entrega',
			4 => 'Información de Pago',
		};

        return view('livewire.cart.page')
			->title($title . ' :: Persé Librerías');
    }
}
