<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCategoryResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\PageResource;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\SeoTags;
use App\PageRole;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\JsonResponse;

class SlugController extends Controller
{
	public function __invoke(string $slug): BookCategoryResource|PageResource|JsonResponse|BookResource
	{
		try
		{
			$seoTags = SeoTags::query()
				->select(['owner_type', 'owner_id', 'meta_title', 'meta_description'])
				->where('slug', $slug)
				->firstOrFail();  /* @var $seoTags SeoTags */

			// Is book?
			if ($seoTags->owner_type == Book::class)
			{
				$type = 'book';

				$query = $seoTags->owner()
					->select(['id', 'category_id', 'publisher_id', 'sku', 'isbn', 'cover', 'title', 'summary', 'year', 'pages_count', 'weight', 'width', 'height', 'price', 'is_presale'])
					->where('is_visible', true)
					->with([
						'authors:id,name,photo,summary',
						'publisher:id,name',
						'category' => function (BelongsTo $query)
						{
							$query
								->select('id', 'name', 'parent_id')
								->where('is_visible', true)
								->with([
									'parent' => function (BelongsTo $query)
									{
										$query
											->select('id', 'name', 'parent_id')
											->with([
												'parent:id,name,parent_id',
												'seoTags:owner_id,owner_type,slug,meta_title,meta_description',
											]);
									},
									'seoTags:owner_id,owner_type,slug,meta_title,meta_description',
								]);
						}
					]);

				$book = $query->findOrFail($seoTags->owner_id);

				$categoryLinks = $this->getBreadCrumbsLinksForCategory($book->category);
				$bookLinks = [['text' => $book->title, 'url' => $seoTags->slug]];

				$resource = new BookResource($book);
				$breadcrumbs = array_merge($categoryLinks, $bookLinks);
			}
			// Is book category?
			elseif ($seoTags->owner_type == BookCategory::class)
			{
				$type = 'book-category';

				$query = $seoTags->owner()
					->select('id', 'name', 'parent_id')
					->where('is_visible', true)
					->with([
						'parent' => function (BelongsTo $query)
						{
							$query
								->select('id', 'name', 'parent_id')
								->with([
									'parent:id,name,parent_id',
									'seoTags:owner_id,owner_type,slug,meta_title,meta_description',
							]);
						},
						'seoTags:owner_id,owner_type,slug,meta_title,meta_description',
					]);

				$category = $query->findOrFail($seoTags->owner_id);

				$resource = new BookCategoryResource($category);
				$breadcrumbs = $this->getBreadCrumbsLinksForCategory($category);
			}
			// Is information page?
			else
			{
				$type = match ($seoTags->owner_id)
				{
					PageRole::AboutUs->value => 'about',
					PageRole::Contact->value => 'contact',
					PageRole::ComplaintsBook->value => 'complaints-book',
					default => 'page'
				};

				$query = $seoTags->owner()
					->select(['id', 'title', 'name', 'content', 'image'])
					->where('is_visible',true);

				$page = $query->findOrFail($seoTags->owner_id);

				$resource = new PageResource($page);
				$breadcrumbs = [['text' => $page->name, 'url' => $seoTags->slug]];
			}

			// Breadcrumbs links
			/*$breadcrumbs = [];
			$breadcrumbResource = $resource;

			for (;;)
			{
				if (!$breadcrumbResource)
					break;

				$breadcrumbs[] = ['name' => $breadcrumbResource->name, 'url' => $breadcrumbResource->seoTags->slug];

				$breadcrumbResource = $breadcrumbResource->parent;
			}

			$breadcrumbs = array_reverse($breadcrumbs);*/

			return $resource->additional(['seo' => $seoTags->toArray(), 'type' => $type, 'breadcrumbs' => $breadcrumbs]);
		}
		catch (ModelNotFoundException)
		{
			return response()->json(status: 404);
		}
	}

	private function getBreadCrumbsLinksForCategory(BookCategory $category): array
	{
		$breadcrumbs = [];
		$breadcrumbsResource = $category;

		for (;;)
		{
			if (!$breadcrumbsResource)
				break;

			$breadcrumbs[] = ['text' => $breadcrumbsResource->name, 'url' => $breadcrumbsResource->seoTags->slug];

			$breadcrumbsResource = $breadcrumbsResource->parent;
		}

		return array_reverse($breadcrumbs);
	}
}
