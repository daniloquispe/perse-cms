<div>
	{{-- Step indicator --}}
	<ul>
		<li>
			<a href="{{ route('cart.list') }}">
				@if($step == 1)
					Paso 1
				@endif
				Carro
			</a>
		</li>
		<li>
			<a href="{{ route('cart.list') }}">
				@if($step == 2)
					Paso 2
				@endif
				Entrega
			</a>
		</li>
		<li>
			<a href="{{ route('cart.list') }}">
				@if($step == 3)
					Paso 3
				@endif
				Pago
			</a>
		</li>
	</ul>
	{{-- Main content --}}
	@if($step == 1)
		<livewire:cart.products-list-section />
	@endif
</div>
