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
					->with(['authors:id,name,photo,summary', 'publisher:id,name']);

				$resource = new BookResource($query->findOrFail($seoTags->owner_id));
			}
			// Is book category?
			elseif ($seoTags->owner_type == BookCategory::class)
			{
				$type = 'book-category';

				$query = $seoTags->owner()
					->select('name')
					->where('is_visible', true)
					->with('books');

				$resource = new BookCategoryResource($query->findOrFail($seoTags->owner_id));
			}
			// Is information page?
			else
			{
				$type = match ($seoTags->owner_id)
				{
					PageRole::AboutUs->value => 'about',
					PageRole::Contact->value => 'contact',
					default => 'page'
				};

				$query = $seoTags->owner()
					->select(['id', 'title', 'name', 'content', 'image'])
					->where('is_visible',true);

				$resource = new PageResource($query->findOrFail($seoTags->owner_id));
			}

			return $resource->additional(['seo' => $seoTags->toArray(), 'type' => $type]);
		}
		catch (ModelNotFoundException)
		{
			return response()->json(status: 404);
		}
	}
}
