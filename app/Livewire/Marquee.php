<?php

namespace App\Livewire;

use App\Models\MarqueeItem;
use Illuminate\Support\Collection;
use Livewire\Component;

class Marquee extends Component
{
	private Collection $items;

	public function mount()
	{
		$this->items = MarqueeItem::query()
			->select(['text', 'url', 'background_color', 'text_color'])
			->where('is_visible', true)
			->orderBy('order')
			->get();
	}

    public function render()
    {
		$data = ['items' => $this->items];

        return view('livewire.marquee', $data);
    }
}
