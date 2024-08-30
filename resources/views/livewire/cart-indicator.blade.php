@if(false)
<a href="{{ route('cart.list') }}">
	<span>Mi Carrito</span>
	{{-- https://www.svgrepo.com/svg/533034/basket-shopping --}}
	<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
</a>
@endif

<div class="cart-indicator">
	<input type="checkbox" wire:model="show" id="cart-sidebar-active" />
	<label for="cart-sidebar-active" class="open-cart-sidebar-button">
		<span>Mi Carrito</span>
		{{-- https://www.svgrepo.com/svg/533034/basket-shopping --}}
		<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
	</label>
	<label for="cart-sidebar-active" id="cart-sidebar-overlay"></label>
	<div class="cart-sidebar-container">
		<div class="sidebar-header">
			<span>
				{{-- https://www.svgrepo.com/svg/533034/basket-shopping --}}
				<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
				Carrito
			</span>
			<label for="cart-sidebar-active" class="close-cart-sidebar-button">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" aria-label="Cerrar">
					<path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
				</svg>
			</label>
		</div>
		<div class="sidebar-content">
			@foreach($items as $item)
				<div wire:key="sidebar-cart-item-{{ $item['book']->id }}" class="cart-item">
					<img src="{{ (new \App\Services\UrlService())->fromAsset($item['book']->cover) }}" alt="{{ $item['book']->title }}" />
					<div class="item-info">
						<p class="book-title">{{ $item['book']->title }}</p>
						<div class="prices">
							@if($item['book']->discounted_price)
								S/&nbsp;{{ $item['book']->discounted_price }}
								<del>S/&nbsp;{{ $item['book']->price }}</del>
							@else
								S/&nbsp;{{ $item['book']->price }}
							@endif
						</div>
						<div>
							<livewire:quantity-input :book-id="$item['book']->id" wire:key="sidebar-cart-quantity-{{ $item['book']->id }}" value="{{ $item['quantity'] }}" />
						</div>
					</div>
					<button type="button" wire:click="removeItem({{ $item['book']->id }})" title="Eliminar">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-label="Eliminar">
							<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
						</svg>
					</button>
				</div>
			@endforeach
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
