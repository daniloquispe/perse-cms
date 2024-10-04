<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class);
	}

	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}
}
