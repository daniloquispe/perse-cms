<?php

namespace App\Livewire\Forms\Cart;

use App\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ApplyCouponForm extends Form
{
	#[Validate('required', message: 'Por favor ingrese un código de cupón')]
	public string $code = '';

	public function apply(): Coupon|null
	{
		$this->validate();

		$coupon = Coupon::query()
			->select(['code', 'id', 'discount_rate'])
			->where('is_enabled', true)
			->where(fn(Builder $query) => $query->whereNull('due_at')->orWhere('due_at', '>=', Carbon::today()))
			->where('code', $this->code)
			->first();

		if ($coupon)
			Cart::applyCoupon($coupon);

		return $coupon;
	}
}
