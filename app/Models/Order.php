<?php

namespace App\Models;

use App\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
	protected $casts = [
		'status' => OrderStatus::class,
		'delivery_date' => 'date',
	];

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class);
	}

	public function items(): HasMany
	{
		return $this->hasMany(OrderItem::class);
	}
}
