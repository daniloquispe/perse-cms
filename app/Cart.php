<?php

namespace App;

use App\Models\Book;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class Cart
{
	private static bool $loaded = false;

	private static int $step = 1;

	private static array $items = [];

	private static float $total;

	private static float $totalDiscount;

//	private static ?int $couponId = null;

	private static ?array $coupon = null;

	private static string $email = '';

	private static string $firstName = '';

	private static string $lastName = '';

	private static string $identityDocumentNumber = '';

	private static string $phone = '';

	private static int $invoiceType = 3;

	private static ?string $ruc = null;

	private static ?string $businessName = null;

	private static int|null $departmentId = null;

	private static int|null $provinceId = null;

	private static int|null $districtId = null;

	public static function getStep(): int
	{
		static::load();

		return static::$step;
	}

	public static function setStep(int $step): void
	{
		static::load();

		static::$step = $step;

		static::save();
	}

	/*public static function getInvoiceType(): int
	{
		static::load();

		return static::$invoiceType;
	}*/

	public static function setPersonalInfo(string $email, string $firstName, string $lastName, string $identityDocumentNumber, string $phone, int $invoiceType, string|null $ruc, string|null $businessName): void
	{
		static::load();

		static::$email = $email;
		static::$firstName = $firstName;
		static::$lastName = $lastName;
		static::$identityDocumentNumber = $identityDocumentNumber;
		static::$phone = $phone;
		static::$invoiceType = $invoiceType;
		static::$ruc = $invoiceType == 3 ? $ruc : null;
		static::$businessName = $invoiceType == 3 ? $businessName : null;

		static::save();
	}

	public static function add(Book $book, int $quantity = 1): void
	{
		static::load();

		if (array_key_exists($book->id, static::$items))
			static::$items[$book->id]['quantity'] += $quantity;
		else
			static::$items[$book->id] = ['book' => $book->toArray(), 'quantity' => $quantity];

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

	public static function applyCoupon(Coupon $coupon): void
	{
		static::load();

		static::$coupon = $coupon->toArray();

		static::save();
	}

	private static function load(): void
	{
//		static::$step = Session::get('cartStep', 1);
//		static::$items = Session::get('cart', []);

		if (self::$loaded)
			return;

		$data = Session::get('cart');

		if ($data)
		{
			static::$step = $data['step'];
			static::$items = $data['items'];
//			static::$couponId = $data['couponId'];
			static::$coupon = $data['coupon'];
			static::$email = $data['email'];

			self::$loaded = true;
		}
	}

	private static function save(): void
	{
//		Session::put('cartStep', static::$step);
//		Session::put('cart', static::$items);

		session::put('cart', static::toArray());
	}

	public static function getItems(): array
	{
		static::load();

		return static::$items;
	}

	public static function getCoupon(): Coupon|null
	{
		if (!static::$coupon)
			return null;

		return new Coupon(static::$coupon);
	}

	public static function getItemsCount(): int
	{
		return count(self::getItems());
	}

	public static function getTotal(): float
	{
		if (!isset(self::$total))
			self::calculateTotals();

		return self::$total;
	}

	public static function getTotalDiscount(): float
	{
		if (!isset(self::$totalDiscount))
			self::calculateTotals();

		return self::$totalDiscount;
	}

	private static function calculateTotals(): void
	{
		self::$total = 0;
		self::$totalDiscount = 0;

		foreach (self::getItems() as $item)
		{
			$book = $item['book'];
			$quantity = $item['quantity'];

			if ($book['discounted_price'])
			{
				self::$total += $book['discounted_price'] * $quantity;
				self::$totalDiscount += ($book['price'] - $book['discounted_price']) * $quantity;
			}
			else
				self::$total += $book['price'] * $quantity;
		}

		// Apply coupon?
		if (self::$coupon)
			self::$total = (100 - self::$coupon['discount_rate']) * self::$total / 100;
	}

	private static function toArray(): array
	{
		$items = [];
		foreach (static::$items as $item)
			$items[$item['book']['id']] = $item;

		return [
			'step' => static::$step,
			'items' => $items,
//			'couponId' => static::$couponId,
			'coupon' => static::$coupon,
			'email' => static::$email,
			'firstName' => static::$firstName,
			'lastName' => static::$lastName,
			'identityDocumentNumber' => static::$identityDocumentNumber,
			'phone' => static::$phone,
			'invoiceType' => static::$invoiceType,
			'ruc' => static::$invoiceType == 1 ? static::$ruc : null,
			'businessName' => static::$invoiceType == 1 ? static::$businessName : null,
			'departmentId' => static::$departmentId,
			'provinceId' => static::$provinceId,
			'districtId' => static::$districtId,
		];
	}
}
