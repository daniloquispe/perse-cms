<?php

namespace App;

use App\Models\Book;
use App\Models\Coupon;
use App\Services\UrlService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart
{
	private static bool $loaded = false;

	private static bool $personalInfoLoaded = false;

	private static int $step = 1;

	private static array $items = [];

	private static float $grossTotal;

	private static float $total;

//	private static float $totalDiscount;

	private static float $totalDiscountFromItems;

	private static float $totalDiscountFromCoupon;

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

	private static string|null $address = null;

	private static string|null $locationNumber = null;

	private static string|null $reference = null;

	private static string|null $recipientName = null;

	private static string|null $deliveryDate = null;

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

	public static function getEmail(): string|null
	{
		static::load();

		return static::$email;
	}

	public static function getFirstName(): string|null
	{
		static::load();

		return static::$firstName;
	}

	public static function getLastName(): string|null
	{
		static::load();

		return static::$lastName;
	}

	public static function getIdentityDocumentNumber(): string|null
	{
		static::load();

		return static::$identityDocumentNumber;
	}

	public static function getPhone(): string|null
	{
		static::load();

		return static::$phone;
	}

	public static function getInvoiceType(): InvoiceType|null
	{
		static::load();

		return InvoiceType::tryFrom(static::$invoiceType);
	}

	public static function getRuc(): string|null
	{
		static::load();

		return static::$ruc;
	}

	public static function getBusinessName(): string|null
	{
		static::load();

		return static::$businessName;
	}

	public static function setPersonalInfo(string $email, string $firstName, string $lastName, string $identityDocumentNumber, string $phone, int $invoiceType, string|null $ruc, string|null $businessName): void
	{
		static::load();

		static::$email = $email;
		static::$firstName = $firstName;
		static::$lastName = $lastName;
		static::$identityDocumentNumber = $identityDocumentNumber;
		static::$phone = $phone;
		static::$invoiceType = $invoiceType;
		static::$ruc = $invoiceType == 1 ? $ruc : null;
		static::$businessName = $invoiceType == 1 ? $businessName : null;

		static::save();
	}

	public static function getDepartmentId(): int|null
	{
		static::load();

		return static::$departmentId;
	}

	public static function getProvinceId(): int|null
	{
		static::load();

		return static::$provinceId;
	}

	public static function getDistrictId(): int|null
	{
		static::load();

		return static::$districtId;
	}

	public static function getAddress(): string|null
	{
		static::load();

		return static::$address;
	}

	public static function getLocationNumber(): string|null
	{
		static::load();

		return static::$locationNumber;
	}

	public static function getReference(): string|null
	{
		static::load();

		return static::$reference;
	}

	public static function getRecipientName(): string|null
	{
		static::load();

		return static::$recipientName;
	}

	public static function getDeliveryDate(): string|null
	{
		static::load();

		return static::$deliveryDate;
	}

	public static function setDeliveryInfo(int $departmentId, int $provinceId, int $districtId, string $address, string $locationNumber, string|null $reference, string|null $recipientName, string $deliveryDate): void
	{
		static::load();

		static::$departmentId = $departmentId;
		static::$provinceId = $provinceId;
		static::$districtId = $districtId;
		static::$address = $address;
		static::$locationNumber = $locationNumber;
		static::$reference = $reference;
		static::$recipientName = $recipientName;
		static::$deliveryDate = $deliveryDate;

		static::save();
	}

	public static function add(Book $book, int $quantity = 1): void
	{
		static::load();

		if (array_key_exists($book->id, static::$items))
			static::$items[$book->id]['quantity'] += $quantity;
		else
		{
			$urlService = new UrlService();

			$bookArray = [
				'id' => $book->id,
				'sku' => $book->sku,
				'title' => $book->title,
				'price' => $book->price,
				'discounted_price' => $book->discounted_price,
				'cover' => $urlService->fromAsset($book->cover_or_placeholder),
			];

			static::$items[$book->id] = ['book' => $bookArray, 'quantity' => $quantity];
		}

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

	public static function getItemSubtotal(int $bookId): float
	{
		static::load();

		$item = static::$items[$bookId];
		$book = $item['book'];

		$quantity = $item['quantity'];
		$price = $book['discounted_price'] ?? $book['price'];

		return $quantity * $price;
	}

	public static function applyCoupon(Coupon $coupon): void
	{
		static::load();

		static::$coupon = $coupon->toArray();
		static::calculateTotals();

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
			static::$coupon = $data['coupon'];

			static::$items = $data['items'];

			static::$email = $data['email'];
			static::$firstName = $data['firstName'];
			static::$lastName = $data['lastName'];
			static::$identityDocumentNumber = $data['identityDocumentNumber'];
			static::$phone = $data['phone'];
			static::$invoiceType = $data['invoiceType'];
			static::$ruc = $data['ruc'];
			static::$businessName = $data['businessName'];

			static::$address = $data['address'];
			static::$locationNumber = $data['locationNumber'];
			static::$reference = $data['reference'];
			static::$recipientName = $data['recipientName'];
			static::$deliveryDate = $data['deliveryDate'];

			static::$personalInfoLoaded = $data['personalInfoLoaded']/* ?? false*/;

			static::$loaded = true;
		}
	}

	private static function save(): void
	{
		if (!static::$personalInfoLoaded && Auth::guard('storefront')->check())
		{
			$customer = Auth::guard('storefront')->user();

			static::$email = $customer->email;
			static::$firstName = $customer->first_name;
			static::$lastName = $customer->last_name;
			static::$identityDocumentNumber = $customer->id_document_number;
			static::$phone = $customer->phone;

			static::$personalInfoLoaded = true;
		}

		Session::put('cart', static::toArray());
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

	public static function getTotalDiscountFromItems(): float
	{
		if (!isset(self::$totalDiscountFromItems))
			static::calculateTotals();

		return static::$totalDiscountFromItems;
	}

	public static function getTotalDiscountFromCoupon(): float
	{
		if (!isset(self::$totalDiscountFromCoupon))
			static::calculateTotals();

		return static::$totalDiscountFromCoupon;
	}

	public static function getTotalDiscount(): float
	{
		return static::getTotalDiscountFromItems() + static::getTotalDiscountFromCoupon();
	}

	private static function calculateTotals(): void
	{
		static::$grossTotal = 0;
		static::$totalDiscountFromItems = 0;
		static::$totalDiscountFromCoupon = 0;

		foreach (self::getItems() as $item)
		{
			$book = $item['book'];
			$quantity = $item['quantity'];

			static::$grossTotal += $book['price'] * $quantity;

			if ($book['discounted_price'])
			{
//				static::$grossTotal += $book['discounted_price'] * $quantity;
				static::$totalDiscountFromItems += ($book['price'] - $book['discounted_price']) * $quantity;
			}
//			else
//				static::$grossTotal += $book['price'] * $quantity;
		}

		// Apply coupon?
		if (static::$coupon)
			static::$totalDiscountFromCoupon = self::$coupon['discount_rate'] * static::$grossTotal / 100;

		static::$total = static::$grossTotal - static::$totalDiscountFromItems - static::$totalDiscountFromCoupon;
	}

	private static function toArray(): array
	{
		$items = [];
		foreach (static::$items as $item)
			$items[$item['book']['id']] = $item;

		return [
			'step' => static::$step,
			'personalInfoLoaded' => static::$personalInfoLoaded,
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
			'address' => static::$address,
			'locationNumber' => static::$locationNumber,
			'reference' => static::$reference,
			'recipientName' => static::$recipientName,
			'deliveryDate' => static::$deliveryDate,
		];
	}

	public function empty(): void
	{
		Session::forget('cart');

		static::load();
	}
}
