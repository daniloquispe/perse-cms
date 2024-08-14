<div class="footer-menu-box">
	<div>
		{{-- Logo --}}
		<a href="{{ route('home') }}"><img src="{{ asset('images/footer-logo.png') }}" alt="Persé Librerías" /></a>
		{{-- Social links --}}
		<livewire:social-links />
	</div>
	<nav>
		<p class="title">Sobre nosotros</p>
		<ul>
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
		<p class="title">Mi cuenta</p>
		<ul>
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
		<p class="title">Atención al cliente</p>
		<ul>
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
			<p class="title">Libro de Reclamaciones</p>
			<ul>
				<li><a href="#"><img src="{{ asset('images/complaints-book.png') }}" alt="Libro de Reclamaciones" /></a></li>
			</ul>
		</nav>
	@endif
</div>
