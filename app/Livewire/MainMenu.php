<?php

namespace App\Livewire;

use App\Models\BookCategory;
use App\Models\Page;
use App\PageRole;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Component;

class MainMenu extends Component
{
	public array $items;

	public function mount()
	{
		// Home
		$homeLinkName = Page::query()
			->whereKey(PageRole::Home->value)
			->value('name');

		$homeLink = ['id' => 0, 'name' => $homeLinkName, 'seo_tags' => ['slug' => route('home')]];
		$links[] = $homeLink;

		// Categories: Level 1
		$categoryLinks = BookCategory::query()
			->select(['id', 'name', 'menu_title'])
			->whereNull('parent_id')
			->where('is_visible', true)
			->orderBy('order')
			->with([
				'seoTags:id,owner_id,slug',
				// Categories: Level 2
				'children' => function (HasMany $query)
				{
					$query
						->select(['id', 'parent_id', 'name'])
						->where('is_visible', true)
						->orderBy('order')
						->with([
							'seoTags:id,owner_id,slug',
							// Categories: level 3
							'children' => function (HasMany $query)
							{
								$query
									->select(['id', 'parent_id', 'name'])
									->where('is_visible', true)
									->orderBy('order')
									->with('seoTags:id,owner_id,slug');
							}
						]);
				}
			])
			->get();

		$this->items = array_merge($links, $categoryLinks->toArray());
	}
    public function render()
    {
        return view('livewire.main-menu');
    }
}
