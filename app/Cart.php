<?php

namespace App;

use App\Models\Book;
use Illuminate\Support\Facades\Session;

class Cart
{
	private static array $items;

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

	private static function load(): void
	{
		static::$items = Session::get('cart', []);
	}

	private static function save(): void
	{
		Session::put('cart', static::$items);
	}

	public static function getItems(): array
	{
		return static::$items;
	}

	public static function getItemsCount(): int
	{
		return isset(self::$items) ? count(self::$items) : 0;
	}
}
