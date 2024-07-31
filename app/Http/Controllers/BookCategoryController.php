<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
	const DEFAULT_PAGE_SIZE = 10;

	public function __invoke(Request $request, int $id)
	{
		$pageNumber = $request->input('page_number', 1);
		$pageSize = $request->input('page_size', self::DEFAULT_PAGE_SIZE);
		$order = $request->input('order');

		$booksQuery = Book::query()
			->select(['id', 'title', 'cover', 'price', 'discounted_price', 'is_presale'])
			->where('is_visible', true)
			->where('category_id', $id)
			->with(['authors:id,name', 'seoTags:owner_id,owner_type,slug']);

		$count = $booksQuery->count();

		$booksQuery->getQuery()
			->take($pageSize)
			->offset(($pageNumber - 1) * $pageSize);

		switch ($order)
		{
			case 1:  // By relevance
				break;

			case 2:  // Latest
				$booksQuery->latest();
				break;

			case 3:  // By price (ascending)
				$booksQuery->orderBy('price');
				break;

			case 4:  // By price (descending)
				$booksQuery->orderByDesc('price');
				break;

			case 5:  // By title (ascending)
				$booksQuery->orderBy('title');
				break;

			case 6:  // By title (descending)
				$booksQuery->orderByDesc('title');
				break;
		}

//		$books = $booksQuery->get();
		$books = BookResource::collection($booksQuery->get());

		$data = compact('books');

		return response()->json(compact('data', 'count'));
	}
}
