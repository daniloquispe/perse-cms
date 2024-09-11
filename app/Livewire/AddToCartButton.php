<?php

namespace App\Livewire;

use App\Cart;
use App\Models\Book;
use Livewire\Component;

class AddToCartButton extends Component
{
	public Book $book;

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }

	public function addToCart(): void
	{
		Cart::add($this->book);

		$this->dispatch('cart-updated');
	}
}
