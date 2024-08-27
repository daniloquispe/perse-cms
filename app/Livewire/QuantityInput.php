<?php

namespace App\Livewire;

use App\Cart;
use Livewire\Component;

class QuantityInput extends Component
{
	public int|string $value = 1;

	public ?int $bookId = null;

	public function decrement(): void
	{
		if ($this->value == 1)
			return;

		$this->value--;
		$this->updateCart();
	}

	public function increment(): void
	{
		$this->value++;
		$this->updateCart();
	}

	private function updateCart(): void
	{
		if ($this->bookId)
		{
			Cart::setQuantity($this->bookId, $this->value);
			$this->dispatch('cart-updated');
		}
	}

	public function checkValue(): void
	{
		if (empty($this->value) || !is_numeric($this->value) || $this->value < 1)
			$this->value = 1;
	}
}
