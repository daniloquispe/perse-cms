<x-customer-card :back-url="route('customer.orders')" title="Pedido Nº {{ $order->number }}">
	{{-- Order info --}}
	<section class="order-info">
		<div class="order-section-header">
			<p class="order-section-title">Información de compra</p>
			<div class="order-section-header-buttonbar">
				@if($order->is_cancellable)
					<a wire:click="cancelOrder" href="#" title="Anular pedido">
						<x-icons.x-mark />
						<span class="hidden sm:inline">Anular pedido</span>
					</a>
				@elseif ($order->cancelled_at)
					<a href="#" class="pointer-events-none" title="Pedido anulado">
						<x-icons.x-mark class="inline size-6" />
						<span class="hidden sm:inline">Pedido anulado</span>
					</a>
				@endif
				<a href="{{ (new \App\Services\UrlService())->fromPageRole(\App\PageRole::Contact) }}" title="Consultas y reclamos">
					<x-icons.pencil-square />
					<span class="hidden sm:inline">Consultas y reclamos</span>
				</a>
			</div>
		</div>
		<div class="order-section-body">
			{{-- Delivery info --}}
			<div>
				<p class="cell-title">Datos de Entrega</p>
				<p class="text-gray-800">{{ $order->recipient_name }}</p>
				<div>
					{{ $order->address }} {{ $order->location_number }}
					<br />{{ $order->district_name }}, {{ $order->province_name }}, {{ $order->department_name }}
					<br />Perú
				</div>
			</div>
			{{-- Payment info --}}
			<div>
				<p class="cell-title">Medios de Pago</p>
				<p class="text-gray-800">{{ $order->payment_method_type->getLabel() }}</p>
				@if(false)
				<p><span class="text-gray-800">Tipo de comprobante:</span> {{ $order->invoice_type->name }}</p>
				<button class="flex items-center justify-center gap-1 w-full border border-palette-orange text-palette-orange rounded-lg py-3">
					<x-icons.document-currency-dollar class="size-6" class="inline size-6" />
					Comprobante de pago
				</button>
				@endif
			</div>
			{{-- Price info --}}
			<div class="prices">
				<div class="price-row">
					<div>Subtotal</div>
					<div>S/&nbsp;{{ number_format($order->subtotal, 2) }}</div>
				</div>
				<div class="price-row">
					<div>Costo del Envío</div>
					<div>S/&nbsp;{{ number_format($order->delivery_price, 2) }}</div>
				</div>
				<div class="price-row">
					<div>Total</div>
					<div>S/&nbsp;{{ number_format($order->total, 2) }}</div>
				</div>
				{{-- Repeat order --}}
				<div class="repeat-order-buttonbar">
					<button wire:click="repeat" class="repeat-order-button">Repetir esta compra</button>
				</div>
			</div>
		</div>
	</section>
	{{-- Order status --}}
	<section class="order-status-info">
		<div class="order-section-body">
			<p class="order-section-title status">Seguimiento de despacho</p>
			<div>
				<div class="steps-indicator for-order">
					<div class="step current">
						<a href="#">
							<span class="marker">
								<x-icons.arrow-path />
							</span>
							Recibido
							<br /><small>{{ $order->created_at->format('d/m/Y') }}</small>
						</a>
					</div>
					<div @class(['step', 'current' => $order->confirmed_at])>
						<a href="#">
							<span class="marker">
								<x-icons.shopping-bag />
							</span>
							Confirmado
							@if($order->confirmed_at)
								<br /><small>{{ $order->confirmed_at->format('d/m/Y') }}</small>
							@endif
						</a>
					</div>
					<div @class(['step', 'current' => $order->delivering_at])>
						<a href="#">
							<span class="marker">
								<x-icons.truck />
							</span>
							En camino
							@if($order->delivering_at)
								<br /><small>{{ $order->delivering_at->format('d/m/Y') }}</small>
							@endif
						</a>
					</div>
					<div @class(['step', 'current' => $order->delivered_at])>
						<a href="#">
							<span class="marker">
								<x-icons.package />
							</span>
							Entregado
							@if($order->delivered_at)
								<br /><small>{{ $order->delivered_at->format('d/m/Y') }}</small>
							@endif
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- Delivery info --}}
	<section class="mb-8">
		<div>
			<p class="order-section-title">Despacho programado</p>
			<p class="mb-4">Entrega {{ $order->delivery_date->locale(config('app.locale'))->isoFormat('dddd D [de] MMMM [de] YYYY') }}, entre 09:00 y las 19:00 hrs.</p>
			<p class="text-lg text-gray-800">Paquete</p>
			<p>Enviado por: <span class="text-gray-800 font-[500] uppercase">Olva</span></p>
		</div>
	</section>
	{{-- Items --}}
	<section class="order-details">
		<div class="header-row">
			<div></div>
			<div>Precio</div>
			<div>Cantidad</div>
			<div>Subtotal</div>
		</div>
		@foreach($order->items as $item)
			<div wire:key="item-{{ $item->id }}" class="body-row">
				<div>
					<img src="{{ asset($item->book->cover_or_placeholder) }}" alt="{{ $item->book->title }}" />
					<div>{{ $item->book->title }}</div>
				</div>
				<div>S/&nbsp;{{ number_format($item->book->price, 2) }}</div>
				<div>{{ $item->quantity }} ud.</div>
				<div>S/&nbsp;{{ number_format($item->book->price, 2) }}</div>
			</div>
		@endforeach
	</section>
</x-customer-card>
