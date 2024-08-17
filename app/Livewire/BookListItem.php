<?php

namespace App\Livewire;

use App\Models\Book;
use App\Services\UrlService;
use Livewire\Component;

class BookListItem extends Component
{
	public Book $book;

	public bool $inCarousel = false;

    public function render(UrlService $urlService)
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
}
