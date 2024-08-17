<?php

namespace App\Http\Controllers;

use App\BookCarouselZone;
use App\Models\BookCarousel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\View\View;

class HomeController extends Controller
{
	public function __invoke(): View
	{
		// Carousels
		$carouselsAbove = $this->carousels(BookCarouselZone::HomeAbove);
		$carouselsBelow = $this->carousels(BookCarouselZone::HomeBelow);

		$data = compact('carouselsAbove', 'carouselsBelow');
		return view('home', $data);
	}

	private function carousels(BookCarouselZone $zone): Collection
	{
		return BookCarousel::query()
			->select(['id', 'title'])
			->where('is_visible', true)
			->where('zone', $zone)
			->whereHas('books', fn(Builder $query) => $query->where('is_visible', true))
			->orderBy('order')
			->with([
				'books' => function (BelongsToMany $query)
				{
					return $query->with(['authors', 'seoTags'])
						->wherePivot('can_be_visible', true)
						->orderByPivot('order');
				},
			])
			->get();
	}
}
