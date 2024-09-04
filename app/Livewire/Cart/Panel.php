<?php

namespace App\Livewire\Cart;

use App\Cart;
use Illuminate\View\View;
use Livewire\Component;

class Panel extends Component
{
	public int $step;

	public string $coupon;

	public function mount(): void
	{
		$this->step = Cart::getStep();
	}

    public function render(): View
    {
		$total = Cart::getTotal();

		$data = compact('total');
        return view('livewire.cart.panel', $data);
    }

	public function nextStep(): void
	{
		Cart::setStep(++$this->step);

		$this->redirectRoute('cart.delivery');
	}
}
