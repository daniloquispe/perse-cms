<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use App\Models\MarqueeItem;
use App\Models\Page;
use App\Models\SocialLink;
use App\PageRole;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class SiteController extends Controller
{
	public function marquee(): JsonResponse
	{
		$query = MarqueeItem::query()
			->select(['text', 'url', 'text_color', 'background_color'])
			->where('is_visible', true)
			->orderBy('order');

		return Response::json(['data' => $query->get()]);
	}

	public function mainMenu(): JsonResponse
	{
		$links = [];

		// Home
		$homeLinkName = Page::query()
			->whereKey(PageRole::Home->value)
			->value('name');

		$homeLink = ['id' => 0, 'name' => $homeLinkName, 'seo_tags' => ['slug' => '']];
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
			->get()
			/*->map(function (BookCategory $category)
			{
				return [
					'name' => $category->name,
					'url' => $category->seoTags->slug,
				];
			})*/;

		$links = ['items' => array_merge($links, $categoryLinks->toArray())];

		return Response::json(['data' => $links]);
	}

	public function socialLinks(): JsonResponse
	{
		$links = SocialLink::query()
			->select(['name', 'url', 'svg'])
			->where('is_visible', true)
			->orderBy('order')
			->get();

		$data = compact('links');

		return Response::json(compact('data'));
	}
}
