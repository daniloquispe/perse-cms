<header class="site-header">
	{{-- Marquee --}}
	<div class="marquee-wrapper">
		<livewire:marquee />
	</div>
	{{-- Main --}}
	<div class="main-wrapper">
		{{-- Main menu (mobile) --}}
		<livewire:mobile-main-menu :items="$menuItems" :active-ids="$activeMenuIds" />
		{{-- Logo --}}
		<div class="logo-cell">
			<a href="{{ route('home') }}"><img src="{{ asset('images/logo-perse-librerias-principal.png') }}" alt="{{ config('app.name') }}" /></a>
		</div>
		{{-- Search (desktop) --}}
		<div class="search-cell">
			<livewire:search-form />
		</div>
		{{-- User --}}
		<div class="user-cell indicator-cell">
			@auth('storefront')
				<a href="{{ route('customer.profile') }}">
					<span>Hola, {{ auth('storefront')->user()->first_name ?? 'usuario' }}</span>
					{{-- https://www.svgrepo.com/svg/532362/user --}}
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
				</a>
			@else
				<a href="{{ $loginUrl }}">
					<span>Iniciar sesión</span>
					{{-- https://www.svgrepo.com/svg/532362/user --}}
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
				</a>
			@endauth
		</div>
		{{-- Cart --}}
		<div class="cart-cell indicator-cell">
			<livewire:cart-indicator />
		</div>
	</div>
	{{-- Main menu (desktop) --}}
	<div class="main-menu-wrapper">
		<livewire:main-menu :items="$menuItems" :active-ids="$activeMenuIds" />
	</div>
	{{-- Search (mobile) --}}
	<div class="mobile-main-menu-wrapper">
		<livewire:search-form />
	</div>
</header>
@if(false)
<header class="site-header">
	<div class="flex flex-col">
		{{-- Marquee --}}
		<div class="h:0 xl:h-9">
			<livewire:marquee />
		</div>
		{{-- Logo, search, login and cart --}}
		{{-- 104.267px = ~6.5rem --}}
		<div class="h-[6.5rem]">
			<div class="main">
				<div>
					{{-- Login --}}
					<div class="user-cell">
						@auth('storefront')
							<a href="{{ route('customer.profile') }}">
								<span>Hola, {{ auth('storefront')->user()->first_name ?? 'usuario' }}</span>
								{{-- https://www.svgrepo.com/svg/532362/user --}}
								<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
							</a>
						@else
							<a href="{{ $loginUrl }}">
								<span>Iniciar sesión</span>
								{{-- https://www.svgrepo.com/svg/532362/user --}}
								<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
							</a>
						@endauth
					</div>
					{{-- Logo --}}
					<div class="logo-cell">
						<a href="{{ route('home') }}"><img src="{{ asset('images/header-logo.png') }}" class="w-56" alt="Persé Librerías" /></a>
					</div>
					{{-- Cart --}}
					<div class="cart-cell">
						<a href="{{ route('cart.list') }}">
							<span>Mi Carrito</span>
							{{-- https://www.svgrepo.com/svg/533034/basket-shopping --}}
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
						</a>
					</div>
					{{-- Search --}}
					<div class="search-cell">
						<label for="main-menu-active" class="open-main-menu-button">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
							</svg>
							<span class="sr-only">Menú</span>
						</label>
						<livewire:search-form />
					</div>
				</div>
			</div>
		</div>
		{{-- Main menu --}}
		{{-- 3.125rem --}}
		<div class="h-[3.125rem]">
			<livewire:main-menu />
		</div>
	</div>
</header>
@endif
