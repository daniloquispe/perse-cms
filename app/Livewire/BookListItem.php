<?php

namespace App\Livewire;

use App\Models\Book;
use App\Services\UrlService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class BookListItem extends Component
{
	use \App\Toast;

	public Book $book;

	public bool $inCarousel = false;

	public bool $asFavorite = false;

	public bool $asRemoved = false;

    public function render(UrlService $urlService): View
    {
		$cover = $urlService->fromAsset($this->book->cover);

		$authors = $this->book->authors->pluck('name')->join(', ');

		$discount = $this->book->discounted_price
			? round(100 * ($this->book->price - $this->book->discounted_price) / $this->book->price)
			: null;

		$url = $urlService->fromSlug($this->book->seoTags->slug);

		$data = compact('cover', 'authors', 'discount', 'url');
        return view('livewire.book-list-item', $data);
    }

	public function removeFromFavorites(): void
	{
		if (Auth::guard('storefront')->user()->favorites()->detach($this->book->id))
		{
			$this->toast('Eliminado de tus Favoritos');
			$this->asRemoved = true;
		}
		else
			$this->toast('No se pudo eliminar de tus Favoritos', 'Por favor, vuelve a intentarlo');
	}
}
