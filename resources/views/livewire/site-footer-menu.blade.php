<div class="footer-menu-box">
	<div>
		{{-- Logo --}}
		<a href="{{ route('home') }}"><img src="{{ asset('images/footer-logo.png') }}" alt="Persé Librerías" /></a>
		{{-- Social links --}}
		<livewire:social-links />
	</div>
	<nav>
		<p class="title" data-menu="1">
			<span>Sobre nosotros</span>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
			</svg>
		</p>
		<ul data-menu="1">
			@if($aboutUsUrl)
				<li><a href="{{ $aboutUsUrl }}">Quiénes Somos</a></li>
			@endif
			@if($contactUrl)
					<li><a href="{{ $contactUrl }}">Contáctenos</a></li>
			@endif
			@if($subscribeUrl)
				<li><a href="{{ $subscribeUrl }}">Suscríbete</a></li>
			@endif
			<li><a href="#">Blog</a></li>
		</ul>
	</nav>
	<nav>
		<p class="title" data-menu="2">
			<span>Mi cuenta</span>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
			</svg>
		</p>
		<ul data-menu="2">
			@if($loginUrl)
				<li><a href="{{ $loginUrl }}">Iniciar Sesión</a></li>
			@endif
			<li><a href="#">Ver mis Pedidos</a></li>
			@if($registerUrl)
				<li><a href="{{ $registerUrl }}">Crear Cuenta</a></li>
			@endif
			<li><a href="#">Recuperar Contraseña</a></li>
		</ul>
	</nav>
	<nav>
		<p class="title" data-menu="3">
			<span>Atención al cliente</span>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
			</svg>
		</p>
		<ul data-menu="3">
			@if($deliveryPolicyUrl)
				<li><a href="{{ $deliveryPolicyUrl }}">Políticas de Envío</a></li>
			@endif
			@if($privacyPolicyUrl)
				<li><a href="{{ $privacyPolicyUrl }}">Políticas de Privacidad</a></li>
			@endif
			@if($cookiesPolicyUrl)
				<li><a href="{{ $cookiesPolicyUrl }}">Políticas de Cookies</a></li>
			@endif
			@if($returnPolicyUrl)
				<li><a href="{{ $returnPolicyUrl }}">Políticas de Devoluciones</a></li>
			@endif
			@if($termsUrl)
				<li><a href="{{ $termsUrl }}">Términos y Condiciones</a></li>
			@endif
		</ul>
	</nav>
	@if($complaintsBookUrl)
		<nav>
			<p class="title" data-menu="4">
				<span>Libro de Reclamaciones</span>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
				</svg>
			</p>
			<ul data-menu="4">
				<li><a href="#"><img src="{{ asset('images/complaints-book.png') }}" alt="Libro de Reclamaciones" /></a></li>
			</ul>
		</nav>
	@endif
</div>
