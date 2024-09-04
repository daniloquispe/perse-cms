<div>
	{{-- Steps indicator --}}
	<div class="cart-steps-wrapper">
		<div class="line"></div>
		<ul class="cart-steps">
			<li>
				<a href="{{ route('cart.list') }}">
					<div @class(['marker', 'current' => $step == 1])>
						<x-icons.cart />
						@if($step == 1)
							<div class="text-sm text-nowrap">Paso 1</div>
						@endif
					</div>
					<div>Carro</div>
				</a>
			</li>
			<li>
				<a href="{{ route('cart.delivery') }}">
					<div @class(['marker', 'current' => $step == 2])>
						<x-icons.truck />
						@if($step == 2)
							Paso 2
						@endif
					</div>
					<div>Entrega</div>
				</a>
			</li>
			<li>
				<a href="{{ route('cart.list') }}">
					<div @class(['marker', 'current' => $step == 3])>
						<x-icons.credit-card />
						@if($step == 3)
							Paso 3
						@endif
					</div>
					<div>Pago</div>
				</a>
			</li>
		</ul>
	</div>
	{{-- Main content --}}
	@if($step == 1)
		<livewire:cart.products-list-section />
	@elseif($step == 2)
		<livewire:cart.delivery-information-section />
	@endif
</div>
