<x-customer-card :back-url="route('customer.orders')" title="Pedido Nº {{ $order->number }}">
	{{-- Order info --}}
	<section class="mb-8">
		<div class="flex justify-between">
			<p class="mb-2 text-xl text-palette-orange font-[500]">Información de compra</p>
			<div class="flex gap-5">
				@if($order->is_cancellable)
					<a wire:click="cancelOrder" href="#" class="flex items-center gap-1 mb-2 underline">
						<x-icons.x-mark class="inline size-6 text-palette-orange stroke-2" />
						Anular pedido
					</a>
				@elseif ($order->cancelled_at)
					<a href="#" class="pointer-events-none">
						<x-icons.x-mark class="inline size-6" />
						Pedido anulado
					</a>
				@endif
				<a href="{{ (new \App\Services\UrlService())->fromPageRole(\App\PageRole::Contact) }}" class="flex items-center gap-1 mb-2 underline">
					<x-icons.pencil-square class="inline size-6 text-palette-orange stroke-2" />
					Consultas y reclamos
				</a>
			</div>
		</div>
		<div class="grid grid-cols-3 divide-x divide-solid divide-gray-300 bg-gray-100 rounded-xl py-5">
			{{-- Delivery info --}}
			<div class="px-16">
				<p class="mb-3 text-lg font-[500] text-gray-800">Datos de Entrega</p>
				<p class="text-gray-800">{{ $order->recipient_name }}</p>
				<div>
					{{ $order->address }} {{ $order->location_number }}
					<br />{{ $order->district_name }}, {{ $order->province_name }}, {{ $order->department_name }}
					<br />Perú
				</div>
			</div>
			{{-- Payment info --}}
			<div class="px-16">
				<p class="mb-3 text-lg font-[500] text-gray-800">Medios de Pago</p>
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
			<div class="px-16">
				<div class="flex justify-between">
					<div>Subtotal</div>
					<div>S/&nbsp;{{ number_format($order->subtotal, 2) }}</div>
				</div>
				<div class="flex justify-between">
					<div>Costo del Envío</div>
					<div>S/&nbsp;{{ number_format($order->delivery_price, 2) }}</div>
				</div>
				<div class="flex justify-between">
					<div>Total</div>
					<div>S/&nbsp;{{ number_format($order->total, 2) }}</div>
				</div>
				{{-- Repeat order --}}
				<div class="mt-16 w-full px-8">
					<button wire:click="repeat" class="w-full border border-palette-orange bg-palette-orange text-white rounded-lg py-3">Repetir esta compra</button>
				</div>
			</div>
		</div>
	</section>
	{{-- Order status --}}
	<section class="mb-8">
		<div class="bg-palette-orange/20 rounded-xl py-4">
			<p class="text-lg text-center text-palette-orange font-[500]">Seguimiento de despacho</p>
			<div>
				<div class="steps-indicator for-order">
					<div class="step current">
						<a href="#">
							<span class="marker">
								<x-icons.cart />
							</span>
							Recibido
							<br /><small>{{ $order->created_at->format('d/m/Y') }}</small>
						</a>
					</div>
					<div @class(['step', 'current' => $order->confirmed_at])>
						<a href="#">
							<span class="marker">
								<x-icons.user />
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
								<x-icons.credit-card />
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
			<p class="mb-2 text-xl text-palette-orange font-[500]">Despacho programado</p>
			<p class="mb-4">Entrega {{ $order->delivery_date->locale(config('app.locale'))->isoFormat('dddd D [de] MMMM [de] YYYY') }}, entre 09:00 y las 19:00 hrs.</p>
			<p class="text-lg text-gray-800">Paquete</p>
			<p>Enviado por: <span class="text-gray-800 font-[500] uppercase">Olva</span></p>
		</div>
	</section>
	{{-- Items --}}
	<section class="mx-32 text-gray-800">
		<div class="grid grid-cols-7 gap-24 font-[500]">
			<div class="col-span-4"></div>
			<div>Precio</div>
			<div>Cantidad</div>
			<div>Subtotal</div>
		</div>
		@foreach($order->items as $item)
			<div wire:key="item-{{ $item->id }}" class="grid grid-cols-7 gap-24 mt-3">
				<div class="col-span-4 flex items-start gap-4">
					<img src="{{ asset($item->book->cover_or_placeholder) }}" alt="{{ $item->book->title }}" class="w-12" />
					<div>{{ $item->book->title }}</div>
				</div>
				<div>S/&nbsp;{{ number_format($item->book->price, 2) }}</div>
				<div>{{ $item->quantity }} ud.</div>
				<div>S/&nbsp;{{ number_format($item->book->price, 2) }}</div>
			</div>
		@endforeach
	</section>
</x-customer-card>
