<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
	protected $casts = [
		'gross_price' => MoneyCast::class,
		'discounted_price' => MoneyCast::class,
	];

	public function price(): Attribute
	{
		return Attribute::make(fn() => $this->gross_price - $this->discounted_price);
	}

	public function subtotal(): Attribute
	{
		return Attribute::make(fn() => $this->price * $this->quantity);
	}

	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class);
	}

	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}
}
