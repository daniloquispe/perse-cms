<x-cart-card>
	<div class="card-header">
		<h2 class="card-title center">
			<x-icons.cart />
			Carro de Compras
		</h2>
	</div>
	<div class="card-body">
		{{-- Cart items --}}
		<div class="cart-items">
			@foreach($items as $item)
				{{-- Separator --}}
				@if(!$loop->first)
					<div class="separator">
						@for($i = 1; $i <= 6; $i++)
							<div>
								<div></div>
							</div>
						@endfor
					</div>
				@endif
				{{-- Item --}}
				<div wire:key="item-{{ $item['book']['id'] }}" class="cart-item">
					<div class="cover-cell">
						{{-- Cover --}}
						<img src="{{ (new \App\Services\UrlService())->fromAsset($item['book']['cover']) }}" alt="{{ $item['book']['title'] }}" />
					</div>
					<div class="info-cell">
						{{-- Book title --}}
						<div class="book-title">{{ $item['book']['title'] }}</div>
						<div class="sku">SKU: {{ $item['book']['sku'] }}</div>
						<ul>
							<li>
								<x-icons.check />
								Despacho a domicilio
							</li>
						</ul>
					</div>
					<div class="price-cell">
						{{-- Unit price --}}
						<div class="price-name first">Precio unitario</div>
						@if($item['book']['discounted_price'])
							<div><del>{{ $item['book']['price'] }}</del></div>
							<div>{{ $item['book']['discounted_price'] }}</div>
						@else
							<br />
							<div>{{ $item['book']['price'] }}</div>
						@endif
					</div>
					<div class="price-cell">
						{{-- Quantity --}}
						<div class="price-name">Cantidad</div>
						<div>
							<br />
							<livewire:quantity-input wire:key="quantity-{{ $item['book']['id'] }}" :value="$item['quantity']" :book-id="$item['book']['id']" />
						</div>
					</div>
					<div class="price-cell">
						{{-- Subtotal --}}
						<div class="price-name last">Subtotal</div>
						<br />
						<div>0.00</div>
					</div>
					<div class="actions-cell">
						{{-- Remove from cart --}}
						<button type="button" wire:click="removeItem({{ $item['book']['id'] }})" title="Eliminar" aria-label="Eliminar del carrito">
							<x-icons.trash />
							<span class="sr-only">Eliminar</span>
						</button>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</x-cart-card>
