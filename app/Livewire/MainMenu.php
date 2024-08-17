<?php

namespace App\Livewire;

use App\Models\BookCategory;
use App\Models\Page;
use App\PageRole;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class MainMenu extends Component
{
	public array $items;

	public array $activeIds;

	public function mount(): void
	{
		$this->loadItems();
		$this->setActiveIds();
	}

    public function render()
    {
        return view('livewire.main-menu');
    }

	private function loadItems(): void
	{
		// Home
		$homeLinkName = Page::query()
			->whereKey(PageRole::Home->value)
			->value('name');

		$homeLink = ['id' => 0, 'name' => $homeLinkName, 'seo_tags' => ['slug' => route('home')], 'children' => []];
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

	private function setActiveIds(): void
	{
		// Home
		if (Route::is('home'))
			$this->activeIds = [0];
		// Book categories
		elseif (Route::current()->hasParameter('slug'))
		{
			$currentSlug = Route::current()->parameters['slug'];

			// Level 1
			foreach ($this->items as $item)
			{
				if ($item['seo_tags']['slug'] == $currentSlug)
					$this->activeIds[] = $item['id'];

				// Level 2
				foreach ($item['children'] as $subItem)
				{
					if ($subItem['seo_tags']['slug'] == $currentSlug)
					{
						$this->activeIds[] = $subItem['id'];
						$this->activeIds[] = $item['id'];
					}

					// Level 3
					foreach ($subItem['children'] as $subItemOption)
						if ($subItemOption['seo_tags']['slug'] == $currentSlug)
						{
							$this->activeIds[] = $subItemOption['id'];
							$this->activeIds[] = $subItem['id'];
							$this->activeIds[] = $item['id'];
						}
				}
			}
		}
		// Other routes
		else
			$this->activeIds = [];
	}
}
