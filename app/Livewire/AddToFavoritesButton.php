<?php

namespace App\Livewire;

use App\Models\Page;
use App\Models\SeoTags;
use App\PageRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class AddToFavoritesButton extends Component
{
	use \App\Toast;

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
		{
			// Login route
			$loginPageSlug = SeoTags::query()
				->where('owner_id', PageRole::Login->value)
				->where('owner_type', Page::class)
				->value('slug');

			$this->toast('Necesitas iniciar sesión antes de agregar un producto a la lista', link: "/$loginPageSlug", linkText: 'Iniciar sesión');

			return;
		}

		$favoritesQuery = Auth::guard('storefront')->user()->favorites();

		// Remove?
		if ($favoritesQuery->exists())
			$favoritesQuery->detach($this->bookId);
		// Add?
		else
			$favoritesQuery->attach($this->bookId);
	}
}
