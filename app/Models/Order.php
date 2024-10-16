<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\InvoiceType;
use App\OrderStatus;
use App\PaymentMethodType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
	protected $casts = [
		'status' => OrderStatus::class,
		'invoice_type' => InvoiceType::class,
		'delivery_date' => 'date',
		'delivery_price' => MoneyCast::class,
		'payment_method_type' => PaymentMethodType::class,
		'payment_method_info' => 'array',
		'confirmed_at' => 'date',
		'delivering_at' => 'date',
		'delivered_at' => 'date',
	];

	public function status(): Attribute
	{
		return Attribute::make(function ()
		{
			if ($this->delivered_at)
				return OrderStatus::Delivered;
			if ($this->delivering_at)
				return OrderStatus::Delivering;
			if ($this->confirmed_at)
				return OrderStatus::Confirmed;
			if ($this->cancelled_at)
				return OrderStatus::Cancelled;
			return OrderStatus::Created;
		});
	}

	public function isConfirmable(): Attribute
	{
		return Attribute::make(fn() => Carbon::now()->diffInHours($this->created_at) < 24);
	}

	public function isCancellable(): Attribute
	{
		return Attribute::make(fn() => $this->status == OrderStatus::Created);
	}

	public function subtotal(): Attribute
	{
		return Attribute::make(function ()
		{
			$total = 0;

			foreach ($this->items as $item)
				$total += $item->subtotal;

			return $total;
		});
	}

	public function total(): Attribute
	{
		return Attribute::make(fn() => $this->subtotal + $this->delivery_price);
	}

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class);
	}

	public function items(): HasMany
	{
		return $this->hasMany(OrderItem::class);
	}

	public function coupon(): BelongsTo
	{
		return $this->belongsTo(Coupon::class);
	}
}
