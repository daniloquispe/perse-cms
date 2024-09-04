<?php

namespace App;

use App\Models\Book;
use Illuminate\Support\Facades\Session;

class Cart
{
	private static int $step;

	private static array $items;

	private static float $total;

	private static float $totalDiscount;

	public static function getStep(): int
	{
		if (!isset(static::$step))
			static::load();

		return static::$step;
	}

	public static function setStep(int $step): void
	{
		if (!isset(static::$step))
			static::load();

		Session::put('cartStep', $step);

		static::save();
	}

	public static function add(Book $book, int $quantity = 1): void
	{
		static::load();

		if (array_key_exists($book->id, static::$items))
			static::$items[$book->id]['quantity'] += $quantity;
		else
			static::$items[$book->id] = ['book' => $book, 'quantity' => $quantity];

		static::save();
	}

	public static function remove(int $bookId): void
	{
		static::load();

		if (array_key_exists($bookId, static::$items))
			unset(self::$items[$bookId]);

		static::save();
	}

	public static function setQuantity(int $bookId, int $quantity): void
	{
		static::load();

		static::$items[$bookId]['quantity'] = $quantity;

		static::save();
	}

	private static function load(): void
	{
		static::$step = Session::get('cartStep', 1);
		static::$items = Session::get('cart', []);
	}

	private static function save(): void
	{
		Session::put('cartStep', static::$step);
		Session::put('cart', static::$items);
	}

	public static function getItems(): array
	{
		static::load();
		return static::$items;
	}

	public static function getItemsCount(): int
	{
		return count(self::getItems());
	}

	public static function getTotal(): float
	{
		if (!isset(self::$total))
			self::getTotals();

		return self::$total;
	}

	public static function getTotalDiscount(): float
	{
		if (!isset(self::$totalDiscount))
			self::getTotals();

		return self::$totalDiscount;
	}

	private static function getTotals(): void
	{
		self::$total = 0;
		self::$totalDiscount = 0;

		foreach (self::getItems() as $item)
		{
			$book = $item['book'];
			$quantity = $item['quantity'];

			if ($book->discounted_price)
			{
				self::$total += $book->discounted_price * $quantity;
				self::$totalDiscount += ($book->price - $book->discounted_price) * $quantity;
			}
			else
				self::$total += $book->price * $quantity;
		}
	}
}
