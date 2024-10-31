<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class NoErpService implements ErpServiceInterface
{
	public function getOrderNumber(): string
	{
		$orderSequence = Order::count() + 1;
		$year = date('y');

		return sprintf("12%011d-%d", $orderSequence, $year);
	}

	public function ping(): JsonResponse
	{
		return response()->json();
	}

	public function products(): JsonResponse
	{
		$books = Book::query()
			->where('is_visible', true)
			->get();

		return $books->count()
			? response()->json($books->toArray())
			: response()->json(status: 404);
	}

	public function product(int $id): JsonResponse
	{
		$book = Book::find($id);

		return $book
			? response()->json($book->toArray(), 302)
			: response()->json(status: 404);
	}
}
