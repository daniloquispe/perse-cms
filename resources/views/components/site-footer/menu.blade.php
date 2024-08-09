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
			<li><a href="/quienes-somos">Quiénes Somos</a></li>
			<li><a href="/contacto">Contáctenos</a></li>
			<li><a href="#">Suscríbete</a></li>
			<li><a href="#">Blog</a></li>
		</ul>
	</nav>
	<nav>
		<p class="title">Mi cuenta</p>
		<ul>
			<li><a href="#">Iniciar Sesión</a></li>
			<li><a href="#">Ver mis Pedidos</a></li>
			<li><a href="/crear-cuenta">Crear Cuenta</a></li>
			<li><a href="#">Recuperar Contraseña</a></li>
		</ul>
	</nav>
	<nav>
		<p class="title">Atención al cliente</p>
		<ul>
			<li><a href="#">Políticas de Envío</a></li>
			<li><a href="/politica-de-privacidad">Políticas de Privacidad</a></li>
			<li><a href="#">Políticas de Cookies</a></li>
			<li><a href="#">Políticas de Devoluciones</a></li>
			<li><a href="#">Términos y Condiciones</a></li>
		</ul>
	</nav>
	<nav>
		<p class="title">Libro de Reclamaciones</p>
		<ul>
			<li><a href="#"><img src="{{ asset('images/complaints-book.png') }}" alt="Libro de Reclamaciones" /></a></li>
		</ul>
	</nav>
</div>
