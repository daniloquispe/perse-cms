<?php

namespace App\Livewire;

use Livewire\Component;

class QuantityInput extends Component
{
	public int|string $value = 1;

	public function decrement(): void
	{
		if ($this->value == 1)
			return;

		$this->value--;
	}

	public function increment(): void
	{
		$this->value++;
	}

	public function checkValue(): void
	{
		if (empty($this->value) || !is_numeric($this->value) || $this->value < 1)
			$this->value = 1;
	}
}
