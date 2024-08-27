@if(false)
<a href="{{ route('cart.list') }}">
	<span>Mi Carrito</span>
	{{-- https://www.svgrepo.com/svg/533034/basket-shopping --}}
	<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
</a>
@endif

<div class="cart-indicator">
	<input type="checkbox" id="cart-sidebar-active" />
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
			<p>Your sopping cart is empty</p>
		</div>
		<div class="sidebar-footer">
			<div class="cart-totals">
				<div>
					<div>Subtotal</div>
					<div>S/95.90</div>
				</div>
				<div>
					<div>Total</div>
					<div>S/95.90</div>
				</div>
			</div>
			<a href="{{ route('cart.list') }}">Comprar</a>
		</div>
	</div>
</div>
