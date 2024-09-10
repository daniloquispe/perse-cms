<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $fillable = ['name', 'code', 'is_enabled', 'discount_rate', 'due_at'];

	protected static function boot()
	{
		parent::boot();

		static::saving(fn(Coupon $model) => $model->code = strtoupper($model->code));
	}
}
