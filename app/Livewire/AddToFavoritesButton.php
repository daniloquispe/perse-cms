<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class AddToFavoritesButton extends Component
{
	public int $bookId;

	public bool $isFavorite = false;

	public function mount(int $bookId): void
	{
		$this->bookId = $bookId;
	}

    public function render(): View
    {
		if (Auth::guard('storefront')->check())
			$this->isFavorite = Auth::guard('storefront')
				->user()
				->favorites()
				->where('book_id', $this->bookId)
				->exists();

        return view('livewire.add-to-favorites-button');
    }

	public function save(): void
	{
		if (!Auth::guard('storefront')->check())
			return;

		$favoritesQuery = Auth::guard('storefront')->user()->favorites();

		// Remove?
		if ($favoritesQuery->exists())
			$favoritesQuery->detach($this->bookId);
		// Add?
		else
			$favoritesQuery->attach($this->bookId);
	}
}
