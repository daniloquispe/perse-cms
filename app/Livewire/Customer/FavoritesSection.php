<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FavoritesSection extends Component
{
	public $favorites;

    public function render(): View
    {
		$this->loadFavorites();

        return view('livewire.customer.favorites-section');
    }

	#[On('favorites-updated')]
	public function loadFavorites(): void
	{
		$this->favorites = Auth::guard('storefront')->user()->favorites;
	}
}
