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
						<x-icons.truck />
						@if($step == 2)
							Paso 2
						@endif
					</div>
					<div>Entrega</div>
				</a>
			</li>
			<li>
				<a wire:click.prevent="goToStep(1)" href="{{ route('cart.list') }}">
					<div @class(['marker', 'current' => $step == 3])>
						<x-icons.credit-card />
						@if($step == 3)
							Paso 3
						@endif
					</div>
					<div>Pago</div>
				</a>
			</li>
		</ul>
	</div>
	<div class="flex gap-8 pb-10">
		<div class="grow">
			{{-- Main content --}}
			@if($step == 1)
				<livewire:cart.products-list-section />
			@elseif($step == 2)
				<livewire:cart.delivery-information-section />
			@endif
		</div>
		<div class="w-[23rem] flex flex-col gap-6">
			<x-cart-card>
				<div class="card-body">
					{{-- Coupon --}}
					<h2 class="section-title">Valida tu cupón</h2>
					<form class="coupon-form">
						<input wire:model="coupon" placeholder="Código de cupón" required="required" aria-label="Código de cupón" />
						<button type="submit">Validar</button>
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
							<div>Total productos</div>
							<div>S/&nbsp;{{ number_format($total, 2) }}</div>
						</div>
						<div>
							<div>Entrega</div>
							<div>Por calcular</div>
						</div>
						<div class="text-gray-800">
							<div>Total</div>
							<div>S/&nbsp;{{ number_format($total, 2) }}</div>
						</div>
					</div>
					<button type="button" wire:click="nextStep" class="checkout-button">Ir a pagar</button>
					<a href="{{ route('home') }}" class="go-back">
						<x-icons.back /> Ver más productos
					</a>
				</div>
			</x-cart-card>
		</div>
	</div>
</div>
