<?php

namespace App\Livewire;

use App\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIndicator extends Component
{
	public bool $showSidebar = false;

	public int $count;

	public array $items;

	public float $total;

	public float $totalDiscount;

    public function render(): View
    {
		$this->loadData();

		return view('livewire.cart-indicator');
    }

	private function loadData(): void
	{
		$this->count = Cart::getItemsCount();
		$this->items = Cart::getItems();
		$this->total = Cart::getTotal();
		$this->totalDiscount = Cart::getTotalDiscount();
	}

	public function removeItem(int $bookId): void
	{
		Cart::remove($bookId);

		$this->loadData();
	}

	#[On('cart-updated')]
	public function openSidebar(): void
	{
		$this->showSidebar = true;
	}
}
