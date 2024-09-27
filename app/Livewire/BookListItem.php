<?php

namespace App\Livewire;

use App\Models\Book;
use App\Services\UrlService;
use App\Toast;
use Illuminate\View\View;
use Livewire\Component;

class BookListItem extends Component
{
	use Toast;

	public Book $book;

	public bool $asFavorite = false;

    public function render(UrlService $urlService): View
    {
		$cover = $urlService->fromAsset($this->book->cover);

		$authors = $this->book->authors->pluck('name')->join(', ');

		$discount = $this->book->has_discount_now
			? round(100 * ($this->book->price - $this->book->discounted_price) / $this->book->price)
			: null;

		$url = $urlService->fromSlug($this->book->seoTags->slug);

		$data = compact('cover', 'authors', 'discount', 'url');
        return view('livewire.book-list-item', $data);
    }
}
