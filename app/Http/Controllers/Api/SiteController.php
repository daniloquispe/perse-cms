<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use App\Models\MarqueeItem;
use App\Models\Page;
use App\Models\SocialLink;
use App\PageRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

		$homeLink = ['name' => $homeLinkName, 'url' => ''];
		$links[] = $homeLink;

		// Categories
		$categoryLinks = BookCategory::query()
			->select(['id', 'name'])
			->whereNull('parent_id')
			->orderBy('order')
			->with('seoTags')
			->get()
			->map(function (BookCategory $category)
			{
				return [
					'name' => $category->name,
					'url' => $category->seoTags->slug,
				];
			});

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
