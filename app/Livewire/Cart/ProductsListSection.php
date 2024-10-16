<?php

namespace App\Livewire\Cart;

use App\Cart;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductsListSection extends Component
{
//	public int $count;

	public array $items;

	public array $subtotals = [];

//	public float $total;

//	public float $totalDiscount;

	#[Layout('components.layouts.cart')]
	#[Title('Lista de productos :: Persé Librerías')]
    public function render(): View
    {
		$this->loadData();

        return view('livewire.cart.products-list-section');
    }

	private function loadData(): void
	{
//		$this->count = Cart::getItemsCount();
		$this->items = Cart::getItems();
//		$this->total = Cart::getTotal();
//		$this->totalDiscount = Cart::getTotalDiscount();

		foreach ($this->items as $id => $item)
			$this->subtotals[$id] = Cart::getItemSubtotal($id);
	}

	public function removeItem(int $bookId): void
	{
		Cart::remove($bookId);

//		$this->loadData();
		$this->dispatch('cart-updated');
	}

	/*public function nextStep(): void
	{
		Cart::setStep(2);

		$this->redirectRoute('cart.delivery');
	}*/

	#[On('cart-updated')]
	public function reloadData(): void
	{
		$this->loadData();
	}
}
