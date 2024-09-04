<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Toast;
use Illuminate\View\View;
use Livewire\Component;

class Panel extends Component
{
	use Toast;

	public string $coupon;

    public function render(): View
    {
		$step = Cart::getStep();
		$items = Cart::getItems();
		$total = Cart::getTotal();

		$data = compact('step', 'items', 'total');
        return view('livewire.cart.panel', $data);
    }

	public function nextStep(): void
	{
		$this->goToStep(Cart::getStep() + 1);
	}

	public function goToStep(int $step): void
	{
		if ($step > 1 && Cart::getItemsCount() == 0)
		{
			$this->toast('Carrito vacío', 'Agrega unos cuantos libros para continuar con tu compra');
			return;
		}

		Cart::setStep($step);

		$routeName = match ($step)
		{
			1 => 'cart.list',
			2 => 'cart.delivery',
			3 => 'home',
		};
		$this->redirectRoute($routeName);
	}
}
