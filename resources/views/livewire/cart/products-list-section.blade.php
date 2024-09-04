<div class="grid grid-cols-12 gap-8">
	<div class="col-span-8 row-span-2">
		<x-cart-card class="row-span-2">
			<div class="card-header">
				<h2 class="card-title center">
					<x-icons.cart />
					Carro de Compras
				</h2>
			</div>
			<div class="card-body">
				{{-- Cart items --}}
				<div class="cart-items">
					@foreach($items as $item)
						{{-- Separator --}}
						@if(!$loop->first)
							<div class="separator">
								@for($i = 1; $i <= 6; $i++)
									<div>
										<div></div>
									</div>
								@endfor
							</div>
						@endif
						{{-- Item --}}
						<div wire:key="item-{{ $item['book']['id'] }}" class="cart-item">
							<div class="cover-cell">
								{{-- Cover --}}
								<img src="{{ (new \App\Services\UrlService())->fromAsset($item['book']['cover']) }}" alt="{{ $item['book']['title'] }}" />
							</div>
							<div class="info-cell">
								{{-- Book title --}}
								<div class="book-title">{{ $item['book']['title'] }}</div>
								<div class="sku">SKU: {{ $item['book']['sku'] }}</div>
								<ul>
									<li>
										<x-icons.check />
										Despacho a domicilio
									</li>
								</ul>
							</div>
							<div class="price-cell">
								{{-- Unit price --}}
								<div class="price-name first">Precio unitario</div>
								<div><del>0.00</del></div>
								<div>0.00</div>
							</div>
							<div class="price-cell">
								{{-- Quantity --}}
								<div class="price-name">Cantidad</div>
								<div>
									<br />
									<livewire:quantity-input wire:key="quantity-{{ $item['book']['id'] }}" :value="$item['quantity']" :book-id="$item['book']['id']" />
								</div>
							</div>
							<div class="price-cell">
								{{-- Subtotal --}}
								<div class="price-name last">Subtotal</div>
								<br />
								<div>0.00</div>
							</div>
							<div class="actions-cell">
								{{-- Remove from cart --}}
								<button type="button" wire:click="removeItem({{ $item['book']['id'] }})" title="Eliminar">
									<x-icons.trash />
									<span class="sr-only">Eliminar</span>
								</button>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</x-cart-card>
	</div>
	<div class="col-span-4">
		<x-cart-card>
			<div class="card-body">
				{{-- Coupon --}}
				<h2 class="section-title">Valida tu cupón</h2>
				<form class="coupon-form">
					<input placeholder="Código de cupón" required="required" aria-label="Código de cupón" />
					<button type="submit">Validar</button>
				</form>
			</div>
		</x-cart-card>
	</div>
	<div class="col-span-4">
		<x-cart-card>
			<div class="card-body">
				{{-- Resume --}}
				<h2 class="section-title">Resumen de tu Compra</h2>
				<div class="totals">
					<div>
						<div>Total productos</div>
						<div>S/&nbsp;{{ number_format(0, 2) }}</div>
					</div>
					<div>
						<div>Entrega</div>
						<div>Por calcular</div>
					</div>
					<div>
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
