<?php

namespace App\Livewire\Cart;

use App\Cart;
use App\Livewire\Forms\Cart\ApplyCouponForm;
use App\Models\Coupon;
use App\Toast;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Panel extends Component
{
	use Toast;

	public ApplyCouponForm $couponForm;

	public Coupon|null $coupon;

	public float $total;

    public function render(): View
    {
		$step = Cart::getStep();
		$items = Cart::getItems();
		$this->loadData();

		$data = compact('step', 'items'/*, 'total'*/);
        return view('livewire.cart.panel', $data);
    }

	public function loadData(): void
	{
		$this->coupon = Cart::getCoupon();
		$this->total = Cart::getTotal();
	}

	public function applyCoupon(): void
	{
		if ($this->couponForm->apply())
			$this->toast('Cupón aplicado', $this->couponForm->code);
		else
			$this->toast('Cupón no válido', 'No se encontró el cupón "' . $this->couponForm->code . '"');
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

	#[On('cart-updated')]
	public function reloadData(): void
	{
		$this->loadData();
	}
}
