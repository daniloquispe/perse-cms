<div class="container-box-cart">
	{{-- Steps indicator (new) --}}
	<div class="cart-steps">
		<div @class(['cart-step', 'current' => $step >= 1])>
			<a wire:click.prevent="goToStep(1)" href="#">
				<span class="marker">
					<x-icons.cart />
				</span>
				Carro
			</a>
		</div>
		<div @class(['cart-step', 'current' => $step >= 2])>
			<a wire:click.prevent="goToStep(2)" href="#">
				<span class="marker">
					<x-icons.user />
				</span>
				Datos
			</a>
		</div>
		<div @class(['cart-step', 'current' => $step >= 3])>
			<a wire:click.prevent="goToStep(3)" href="#">
				<span class="marker">
					<x-icons.truck />
				</span>
				Entrega
			</a>
		</div>
		<div @class(['cart-step', 'current' => $step >= 4])>
			<a wire:click.prevent="goToStep(4)" href="#">
				<span class="marker">
					<x-icons.credit-card />
				</span>
				Pago
			</a>
		</div>
	</div>

	{{-- Main content --}}
	<div class="lg:flex lg:gap-8 pb-10">
		<div class="grow mb-6 lg:mb-0">
			{{-- Main content --}}
			@if($step == 1)
				<livewire:cart.products-list-section />
			@elseif($step == 2)
				<livewire:cart.personal-info-section />
			@elseif($step == 3)
				<livewire:cart.delivery-info-section />
			@elseif($step == 4)
				<livewire:cart.payment-info-section />
			@endif
		</div>

		{{-- Sidebar --}}
		<div class="lg:w-[23rem] flex flex-col gap-6">
			{{-- Coupon --}}
			@if($this->showCouponForm)
				<x-cart-card>
					<div class="card-body">
						{{-- Coupon --}}
						<h2 class="section-title">Valida tu cupón</h2>
						<form wire:submit="applyCoupon" class="coupon-form">
							<div class="flex gap-2">
								<div class="grow">
									<input wire:model="couponForm.code" wire:blur="couponForm.code = $wire.couponForm.code.toUpperCase()" placeholder="Código de cupón" required="required" aria-label="Código de cupón" />
								</div>
								<button type="submit">Validar</button>
							</div>
							@error('couponForm.code')
								<div class="form-error">{{ $message }}</div>
							@enderror
						</form>
					</div>
				</x-cart-card>
			@endif
			<x-cart-card>
				<div class="card-body">
					{{-- Resume --}}
					<h2 class="section-title">Resumen de tu Compra</h2>
					@if($step > 1)
						<div class="mb-10 max-h-60 overflow-y-scroll">
							@foreach($items as $item)
								<div class="flex items-center gap-3 border border-gray-300 rounded-lg p-2 mb-2">
									<div class="w-16 shrink-0">
										<img src="{{ (new \App\Services\UrlService())->fromAsset($item['book']['cover']) }}" alt="{{ $item['book']['title'] }}" />
									</div>
									<div class="grow">
										<div class="text-xs text-left">{{ $item['book']['title'] }}</div>
										<div class="text-xs">&times;{{ $item['quantity'] }}</div>
									</div>
									<div class="w-20 text-xs text-right text-gray-800 font-[500]">
										@if($item['book']['discounted_price'])
											<del class="font-normal opacity-60">S/&nbsp;{{ $item['book']['price'] }}</del>
											<br />S/&nbsp;{{ $item['book']['discounted_price'] }}
										@else
											S/&nbsp;{{ $item['book']['price'] }}
										@endif
									</div>
								</div>
							@endforeach
						</div>
					@endif
					<div class="totals">
						<div>
							<div>Subtotal</div>
							<div>S/&nbsp;{{ number_format($total, 2) }}</div>
						</div>
						<div>
							<div>Entrega</div>
							<div>
								@if($deliveryPrice)
									S/&nbsp;{{ number_format($deliveryPrice, 2) }}
								@else
									Por calcular
								@endif
							</div>
						</div>
						@if($coupon)
							<div>
								<div>Cupón "{{ $coupon->code }}"</div>
								<div>&minus;{{ $coupon->discount_rate }}%</div>
							</div>
						@endif
						<div class="text-gray-800">
							<div>Total</div>
							<div>S/&nbsp;{{ number_format($total, 2) }}</div>
						</div>
					</div>
					<button type="button" wire:click="nextStep" @disabled($step == 2 || $step == 3) class="checkout-button">Ir a pagar</button>
					@if($step > 1)
						<a wire:click.prevent="goToStep(1)" href="{{ route('cart.list') }}" class="go-back">
							<x-icons.back /> Volver al Carrito
						</a>
					@else
						<a href="{{ route('home') }}" class="go-back">
							<x-icons.back /> Ver más productos
						</a>
					@endif
				</div>
			</x-cart-card>
		</div>
	</div>
</div>

@assets
	<style>
		.container-box-cart
		{
			@apply !bg-red-700;
		}
	</style>
@endassets
