<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class FavoritesSection extends Component
{
	public $favorites;

    public function render(): View
    {
		$this->favorites = Auth::guard('storefront')->user()->favorites;

        return view('livewire.customer.favorites-section');
    }
}
