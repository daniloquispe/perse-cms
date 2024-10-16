<div class="container-box-cart py-10">
	<x-cart-card>
		<div class="card-body text-center">
			<x-icons.check-circle class="inline size-24 mb-4 stroke-1 text-green-500" />
			<p class="mb-4 text-2xl">¡Gracias por la compra!</p>
			<p class="mb-4">En breves minutos, recibirá un correo electrónico en <strong>{{ session('orderEmail') }}</strong> con todos los detalles de su compra.
				<br />Recuerde revisar su buzón de correo no deseado o promociones.</p>
			<div class="my-8">
				<a href="{{ route('home') }}" class="home-link">Ir al Inicio</a>
			</div>
			<ul class="final-notes">
				<li>La aprobación del pago puede tardar desde 5 minutos hasta 5 días hábiles.</li>
				<li>El período de entrega comienza a contar desde el momento en que se confirma el pago.</li>
				<li>Se enviará un código de seguimiento a su correo electrónico cuando comience el proceso de entrega.</li>
			</ul>
		</div>
	</x-cart-card>
</div>
