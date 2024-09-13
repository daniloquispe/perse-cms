<div class="cart-indicator">
	<input type="checkbox" wire:model="showSidebar" id="cart-sidebar-active" />
	<label for="cart-sidebar-active" class="open-cart-sidebar-button">
		<span class="icon-label">Mi Carrito</span>
		<div class="counter-wrapper">
			{{-- Icon --}}
			<x-icons.cart />
			{{-- Counter --}}
			@if($count > 0)
				<span class="counter">{{ $count }}</span>
			@endif
		</div>
	</label>
	<label for="cart-sidebar-active" id="cart-sidebar-overlay"></label>
	<div class="cart-sidebar-container">
		<div class="sidebar-header">
			<span>
				<x-icons.cart />
				Carrito
			</span>
			<label for="cart-sidebar-active" class="close-cart-sidebar-button">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" aria-label="Cerrar">
					<path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
				</svg>
			</label>
		</div>
		<div class="sidebar-content">
			@forelse($items as $item)
				<div wire:key="sidebar-cart-item-{{ $item['book']['id'] }}" class="cart-item">
					<img src="{{ (new \App\Services\UrlService())->fromAsset($item['book']['cover']) }}" alt="{{ $item['book']['title'] }}" />
					<div class="item-info">
						<p class="book-title">{{ $item['book']['title'] }}</p>
						<div class="prices">
							@if($item['book']['discounted_price'])
								S/&nbsp;{{ $item['book']['discounted_price'] }}
								<del>S/&nbsp;{{ $item['book']['price'] }}</del>
							@else
								S/&nbsp;{{ $item['book']['price'] }}
							@endif
						</div>
						<div>
							<livewire:quantity-input :book-id="$item['book']['id']" wire:key="sidebar-cart-quantity-{{ $item['book']['id'] }}" value="{{ $item['quantity'] }}" />
						</div>
					</div>
					<button type="button" wire:click="removeItem({{ $item['book']['id'] }})" title="Eliminar">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-label="Eliminar">
							<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
						</svg>
					</button>
				</div>
			@empty
				<div class="h-full flex items-center justify-center">
					<div class="text-center">
						<div class="size-32 mx-auto mb-4 rounded-full p-7 bg-palette-purple/20">
							<x-icons.cart class="text-palette-purple" />
						</div>
						<p class="text-lg">Tu carrito está vacío</p>
					</div>
				</div>
			@endforelse
		</div>
		<div class="sidebar-footer">
			{{-- Totals --}}
			<div class="cart-totals">
				@if($totalDiscount)
					<div>
						<div>Subtotal</div>
						<div>S/&nbsp;{{ $total + $totalDiscount }}</div>
					</div>
					<div>
						<div>Descuento</div>
						<div>&ndash; S/&nbsp;{{ $totalDiscount }}</div>
					</div>
				@endif
				<div>
					<div>Total</div>
					<div>S/&nbsp;{{ $total }}</div>
				</div>
			</div>
			{{-- Checkout --}}
			<a href="{{ route('cart.list') }}">Comprar</a>
		</div>
	</div>
</div>
