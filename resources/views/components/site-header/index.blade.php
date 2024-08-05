<header class="site-header">
	{{-- Marquee --}}
	<livewire:marquee />
	{{-- Logo, search, login and cart --}}
	<div class="main">
		<div class="container-box">
			<div class="user-cell">
				@auth('storefront')
					<a href="{{ route('logout') }}">Cerrar sesión</a>
				@else
					<a href="/iniciar-sesion">Iniciar sesión</a>
				@endauth
				{{-- https://www.svgrepo.com/svg/532362/user --}}
				<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
			</div>
			<div class="logo-cell">
				<a href="{{ route('home') }}"><img src="{{ asset('images/header-logo.png') }}" class="w-56" alt="Persé Librerías" /></a>
			</div>
			<div class="cart-cell">
				<a href="{{ route('cart.list') }}">Mi Carrito</a>
				{{-- https://www.svgrepo.com/svg/533034/basket-shopping --}}
				<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
			</div>
			<div class="search-cell">
				<x-site-header.search />
			</div>
		</div>
	</div>
	{{-- Main menu --}}
	<livewire:main-menu />
</header>
