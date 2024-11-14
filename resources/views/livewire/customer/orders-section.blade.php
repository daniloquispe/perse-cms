<x-customer-card title="Pedidos" subtitle="Aquí podrá encontrar el historial de tus compras a detalle y toda la información relevante sobre tu despacho">
	@if($orders->count())
		<div class="orders-list">
			<div class="orders-list-header">
				<div>Fecha de compra</div>
				<div>Pedido N&ordm;</div>
				<div>Total</div>
				<div></div>
			</div>
			@foreach($orders as $order)
				<div wire:key="order-{{ $order->id }}" class="orders-list-row">
					<div class="orders-list-row-summary">
						{{-- Order date --}}
						<div>{{ $order->created_at->locale(config('app.locale'))->isoFormat('D MMM YYYY') }}</div>
						{{-- Order number --}}
						<div>{{ $order->number }}</div>
						{{-- Total price --}}
						<div>S/&nbsp;{{ number_format($order->total, 2) }}</div>
						{{-- Actions --}}
						<div>
							<a href="{{ route('customer.order', $order) }}" class="order-details-button">Ver detalle <span>del pedido</span></a>
						</div>
					</div>
					{{-- Items --}}
					<div class="orders-list-row-detail">
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
		</div>
	@endif
</x-customer-card>
