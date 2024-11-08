<x-customer-card title="Pedidos" subtitle="Aquí podrá encontrar el historial de tus compras a detalle y toda la información relevante sobre tu despacho">
	@if($orders->count())
		<div class="grid grid-cols-5 font-[500] -mt-3 pb-3 border-b border-palette-orange">
			<div class="col-span-2">Fecha de compra</div>
			<div class="text-center">Pedido N&ordm;</div>
			<div class="text-center">Total</div>
			<div></div>
		</div>
		@foreach($orders as $order)
			<div wire:key="order-{{ $order->id }}" class="mt-5 flex flex-col gap-5">
				<div class="grid grid-cols-5">
					{{-- Order date --}}
					<div class="col-span-2">{{ $order->created_at->locale(config('app.locale'))->isoFormat('D MMM YYYY') }}</div>
					{{-- Order number --}}
					<div class="text-center">{{ $order->number }}</div>
					{{-- Total price --}}
					<div class="text-center">S/&nbsp;{{ number_format($order->total, 2) }}</div>
					{{-- Actions --}}
					<div>
						<a href="{{ route('customer.order', $order) }}" class="block py-1 bg-gray-100 text-gray-800 text-center uppercase">Ver detalle del pedido</a>
					</div>
				</div>
				{{-- Items --}}
				<div class="flex flex-col gap-2">
					@foreach($order->items as $item)
						<div wire:key="item-{{ $item->id }}" class="flex items-center gap-4">
							<img src="{{ asset($item->book->cover_or_placeholder) }}" alt="{{ $item->book->title }}" class="w-12" />
							<div>
								<p class="uppercase">{{ $item->book->title }}</p>
								<div class="flex gap-3 text-sm font-[500]">
									<div>{{ $item->quantity }} ud.</div>
									<div>S/&nbsp;{{ number_format($item->subtotal, 2) }}</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
	@endif
</x-customer-card>
