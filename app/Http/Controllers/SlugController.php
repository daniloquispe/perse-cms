<?php

namespace App\Http\Controllers;

use App\CommentStatus;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\SeoTags;
use App\PageRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\View\View;

class SlugController extends Controller
{
	public function __invoke(string $slug): View
	{
		$seoTags = SeoTags::query()
			->select(['owner_type', 'owner_id', 'meta_title', 'meta_description'])
			->where('slug', $slug)
			->firstOrFail();  /* @var $seoTags SeoTags */

		// Is book?
		if ($seoTags->owner_type == Book::class)
		{
			$type = 'book';

			$query = $this->getBookQuery($seoTags);

			$book = $query->findOrFail($seoTags->owner_id);

			$categoryLinks = $this->getBreadCrumbsLinksForCategory($book->category);
			$bookLinks = [['text' => $book->title, 'url' => $seoTags->slug]];

			$breadcrumbs = array_merge($categoryLinks, $bookLinks);

			$data = compact('book', 'breadcrumbs');
		}
		// Is book category?
		elseif ($seoTags->owner_type == BookCategory::class)
		{
			$type = 'book-category';

			$query = $seoTags->owner()
				->select('id', 'name', 'parent_id', 'search_results_label')
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

			$breadcrumbs = $this->getBreadCrumbsLinksForCategory($category);

			$data = compact('category', 'breadcrumbs');
		}
		// Is information page?
		else
		{
			$type = match ($seoTags->owner_id)
			{
				PageRole::AboutUs->value => 'about',
				PageRole::Contact->value => 'contact',
				PageRole::ComplaintsBook->value => 'complaints-book',
				PageRole::Login->value => 'login',
				PageRole::Register->value => 'register',
				PageRole::Subscribe->value => 'subscribe',
				default => 'page'
			};

			$query = $seoTags->owner()
				->select(['id', 'title', 'name', 'content', 'image'])
				->where('is_visible',true);

			$page = $query->findOrFail($seoTags->owner_id);

			$breadcrumbs = [['text' => $page->name, 'url' => $seoTags->slug]];

			$data = compact('page', 'breadcrumbs');
		}

		return view($type, $data);
	}

	private function getBookQuery(SeoTags $seoTags): MorphTo
	{
		return $seoTags->owner()
			->select(['id', 'category_id', 'publisher_id', 'book_format_id', 'bookbinding_type_id', 'age_range_id', 'sku', 'isbn', 'cover', 'title', 'summary', 'year', 'pages_count', 'weight', 'width', 'height', 'price', 'is_presale'])
			->where('is_visible', true)
			->with([
				'authors:id,name,photo,summary',
				'publisher:id,name',
				'bookFormat:id,name',
				'bookbindingType:id,name',
				'ageRange:id,name',
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
				},
				'comments' => function (HasMany $query)
				{
					$query->where('status', CommentStatus::Approved)->latest();
				}
			]);
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
