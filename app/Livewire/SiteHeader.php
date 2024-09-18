<?php

namespace App\Livewire;

use App\Models\BookCategory;
use App\Models\Page;
use App\PageRole;
use App\Services\UrlService;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class SiteHeader extends Component
{
	public function render(UrlService $urlService): View
    {
		$loginUrl = $urlService->fromPageRole(PageRole::Login);

		$menuItems = $this->loadMenuItems();
		$activeMenuIds = $this->setActiveMenuIds($menuItems);

		$data = compact('loginUrl', 'menuItems', 'activeMenuIds');
        return view('livewire.site-header', $data);
    }

	private function loadMenuItems(): array
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

		return array_merge($links, $categoryLinks->toArray());
	}

	private function setActiveMenuIds(array $menuItems): array
	{
		$activeIds = [];

		// Home
		if (Route::is('home'))
			$activeIds = [0];
		// Book categories
		elseif (Route::current()->hasParameter('slug'))
		{
			$currentSlug = Route::current()->parameters['slug'];

			// Level 1
			foreach ($menuItems as $item)
			{
				if ($item['seo_tags']['slug'] == $currentSlug)
					$activeIds[] = $item['id'];

				// Level 2
				foreach ($item['children'] as $subItem)
				{
					if ($subItem['seo_tags']['slug'] == $currentSlug)
					{
						$activeIds[] = $subItem['id'];
						$activeIds[] = $item['id'];
					}

					// Level 3
					foreach ($subItem['children'] as $subItemOption)
						if ($subItemOption['seo_tags']['slug'] == $currentSlug)
						{
							$activeIds[] = $subItemOption['id'];
							$activeIds[] = $subItem['id'];
							$activeIds[] = $item['id'];
						}
				}
			}
		}
		// Other routes
		else
			$activeIds = [];

		return $activeIds;
	}
}
