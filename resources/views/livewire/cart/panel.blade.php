<div class="container-box-cart">
	{{-- Steps indicator --}}
	<div class="cart-steps-wrapper">
		<div class="line"></div>
		<ul class="cart-steps">
			<li>
				<a wire:click.prevent="goToStep(1)" href="{{ route('cart.list') }}">
					<div @class(['marker', 'current' => $step == 1])>
						<x-icons.cart />
						@if($step == 1)
							<div class="text-sm text-nowrap">Paso 1</div>
						@endif
					</div>
					<div>Carro</div>
				</a>
			</li>
			<li>
				<a wire:click.prevent="goToStep(2)" href="{{ route('cart.delivery') }}">
					<div @class(['marker', 'current' => $step == 2])>
						<x-icons.user />
						@if($step == 2)
							Paso 2
						@endif
					</div>
					<div>Datos</div>
				</a>
			</li>
			<li>
				<a wire:click.prevent="goToStep(2)" href="{{ route('cart.delivery') }}">
					<div @class(['marker', 'current' => $step == 3])>
						<x-icons.truck />
						@if($step == 3)
							Paso 3
						@endif
					</div>
					<div>Entrega</div>
				</a>
			</li>
			<li>
				<a wire:click.prevent="goToStep(1)" href="{{ route('cart.list') }}">
					<div @class(['marker', 'current' => $step == 4])>
						<x-icons.credit-card />
						@if($step == 4)
							Paso 4
						@endif
					</div>
					<div>Pago</div>
				</a>
			</li>
		</ul>
	</div>
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
		<div class="lg:w-[23rem] flex flex-col gap-6">
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
			<x-cart-card>
				<div class="card-body">
					{{-- Resume --}}
					<h2 class="section-title">Resumen de tu Compra</h2>
					@if($step > 1)
						<div class="mb-10 h-60 overflow-y-scroll">
							@foreach($items as $item)
								<div class="flex items-center gap-3 border border-gray-300 rounded-lg p-2 mb-2">
									<div class="w-16 shrink-0">
										<img src="{{ (new \App\Services\UrlService())->fromAsset($item['book']['cover']) }}" alt="{{ $item['book']['title'] }}" />
									</div>
									<div class="grow">
										<div class="text-xs text-left">{{ $item['book']['title'] }}</div>
										<div class="text-xs">x{{ $item['quantity'] }}</div>
									</div>
									<div class="w-20 text-xs text-right text-gray-800 font-[500]">
										S/&nbsp;{{ $item['book']['price'] }}
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
							<div>Por calcular</div>
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
					<button type="button" wire:click="nextStep" class="checkout-button">Ir a pagar</button>
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
