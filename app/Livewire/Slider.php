<?php

namespace App\Livewire;

use App\Models\Slide;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Component;

class Slider extends Component
{
	public Collection $slides;

	public function mount()
	{
		$query = \App\Models\Slider::query()
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

		$mainSlider = $query->first();

		if ($mainSlider)
		{
			$mainSlider->slides->map(fn(Slide $slide) => $slide->image = asset('storage/' . $slide->image));

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
