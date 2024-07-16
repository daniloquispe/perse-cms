<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeController extends Controller
{
	public function slider(): SliderResource
	{
		$query = Slider::query()
			->select(['id', 'name', 'delay'])
			->where('is_visible', true)
			->with([
				'slides' => function (HasMany $query): void
				{
					$query
						->select(['slider_id', 'name', 'image', 'url'])
						->where('is_enabled', true)
						->orderBy('order');
				}
			]);

		return new SliderResource($query->firstOrFail());
	}
}
