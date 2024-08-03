<?php

namespace App\Livewire;

use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SocialLinks extends Component
{
	public Collection $links;

	public function mount(): void
	{
		$links = SocialLink::query()
			->select(['name', 'url', 'svg'])
			->where('is_visible', true)
			->orderBy('order')
			->get();

		$this->links = $links;
	}

    public function render()
    {
        return view('livewire.social-links');
    }
}
