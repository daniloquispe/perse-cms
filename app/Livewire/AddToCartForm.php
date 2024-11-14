<?php

namespace App\Livewire;

use App\Cart;
use App\Models\Book;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddToCartForm extends Component
{
	public Book $book;

	#[Validate('required', message: 'Ingresa una cantidad')]
	#[Validate('integer', message: 'Ingresa una cantidad válida')]
	public int $quantity = 1;

    public function render(): View
    {
        return view('livewire.add-to-cart-form');
    }

	public function increment(): void
	{
		$this->quantity++;
	}

	public function decrement(): void
	{
		if ($this->quantity > 1)
			$this->quantity--;
	}

	public function addToCart(): void
	{
		$this->validate();

		Cart::add($this->book, $this->quantity);

		$this->dispatch('cart-updated');
	}
}
