<?php

namespace App\Livewire;

use App\Models\Slide;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Component;

class Slider extends Component
{
	public Collection $slides;

	public function mount(): void
	{
		$query = \App\Models\Slider::query()
			->select(['id', 'name', 'delay'])
			->where('is_visible', true)
			->with([
				'slides' => function (HasMany $query): void
				{
					$query
						->select(['slider_id', 'name', 'image', 'image_mobile', 'url'])
						->where('is_visible', true)
						->orderBy('order');
				}
			]);

		$mainSlider = $query->first();

		if ($mainSlider)
		{
			$mainSlider->slides->map(function (Slide $slide)
			{
				$slide->image = asset('storage/' . $slide->image);
				$slide->image_mobile = asset('storage/' . $slide->image_mobile);
			});

			$this->slides = $mainSlider->slides;
		}
		else
			$this->slides = collect();

	}

    public function render()
    {
        return view('livewire.slider');
    }
}
