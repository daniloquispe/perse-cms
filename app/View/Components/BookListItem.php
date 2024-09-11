<?php

namespace App\View\Components;

use App\Models\Book;
use App\Services\UrlService;
use App\Toast;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookListItem extends Component
{
	use Toast;

	private UrlService $urlService;

    /**
     * Create a new component instance.
     */
    public function __construct(public Book $book, public bool $asFavorite = false)
    {
		$this->urlService = new UrlService();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
		$cover = $this->urlService->fromAsset($this->book->cover);

		$authors = $this->book->authors->pluck('name')->join(', ');

		$discount = $this->book->has_discount_now
			? round(100 * ($this->book->price - $this->book->discounted_price) / $this->book->price)
			: null;

		$url = $this->urlService->fromSlug($this->book->seoTags->slug);

		$data = compact('cover', 'authors', 'discount', 'url');
        return view('components.book-list-item', $data);
    }
}
