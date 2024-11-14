@extends('mail.mail-layout')

@section('title', "Tu pedido Nº {$order->number} fue aprobado!")

@section('styles')
    <style>
		.order-text-block
		{
			display: grid;
			grid-template-columns: repeat(4, minmax(0, 1fr));
			gap: 0.5rem;
			align-items: stretch;

			h1
			{
				margin: 0;
				padding: 0;
				font-size: 2rem;
			}

			> div
			{
				align-self: stretch;
				padding: 1.5rem;
				color: #fff;

				.text
				{
					p
					{
						font-size: 0.9rem;
						margin-bottom: 1rem;
						line-height: 1.3rem;

						&:last-child
						{
							margin-bottom: 0;
						}
					}
				}

				&:first-child
				{
					grid-column: span 3 / span 3;
					display: flex;
					flex-direction: column;
					gap: 1rem;
					margin: 0;
					padding: 1rem;
					background-color: #9143bc;
					text-align: justify;
				}

				&:last-child
				{
					display: flex;
					background-color: #ff8300;
				}

				/*p
				{
					margin-bottom: 1rem;

					&:last-child
					{
						margin-bottom: 0;
					}
				}*/
			}
		}

		h2
		{
			margin: 1.5rem 0;
			font-weight: 500;
			font-size: 1rem;
			text-align: center;
			text-transform: uppercase;
			letter-spacing: 0.2rem;
		}

		.resume-table
		{
			display: table;
			border-collapse: separate;
			border-spacing: 0.8rem;
			width: 100%;
			/*margin: 0 3rem;*/

			> div
			{
				display: table-row;

				> p
				{
					display: table-cell;
					padding-top: 0;
					padding-bottom: 0;
					text-align: left;
					font-size: 0.9rem;
					line-height: 1.3rem;

					&:first-child
					{
						padding-left: 3rem;
						padding-right: 0.5rem;
					}

					&:last-child
					{
						padding-right: 3rem;
						padding-left: 0.5rem;
					}
				}
			}
		}

		/*.totals-table
		{
			display: table;
			border-collapse: collapse;
			width: 100%;

			> div
			{
				display: table-row;

				> div
			}
		}*/

		.total-row
		{
			display: flex;
			justify-content: space-between;
			margin: 0 1rem;

			&.even
			{
				background-color: #e9e9e9;
			}

			> div
			{
				padding: 1rem;

				&:first-child
				{
					padding-left: 5rem;
				}

				&:last-child
				{
					padding-right: 5rem;
				}
			}

			&.total > div:first-child
			{
				color: #9143bc;
				font-weight: bold;
				text-transform: uppercase;
			}
		}

		{{-- Order status --}}

		.order-steps
		{
			display: flex;
			justify-content: center;
			margin-bottom: 2.5rem;

			.cart-step
			{
				width: 8rem;
				display: flex;
				justify-content: center;
				position: relative;

				a
				{
					display: flex;
					flex-direction: column;
					align-items: center;
					text-align: center;
					width: 100%;
					pointer-events: none;
					color: #2e2e2e;
					text-decoration: none;
				}

				.marker
				{
					width: 2.5rem;
					height: 2.5rem;
					position: relative;
					display: flex;
					justify-content: center;
					align-items: center;
					border: 1px solid #cbcbcb;
					border-radius: 9999px;
					margin-bottom: 0.375rem;
					background-color: #cbcbcb;

					svg
					{
						width: 1.5rem;
						height: 1.5rem;
						color: #fff;
					}
				}
			}

			.cart-step.current
			{
				.marker
				{
					border-color: rgb(255 131 0);
					background-color: rgb(255 131 0);
				}
			}

			.cart-step:before
			{
				background-color: #cbcbcb;
				height: 0.125rem;
				position: absolute;
				top: 1.25rem;
				right: 50%;
				width: calc(100% - 1.25rem);
				content: '';
			}

			.cart-step.current:before
			{
				background-color: rgb(255 131 00);
			}

			.cart-step:first-child:before
			{
				display: none;
			}
		}

		{{-- Delivery --}}

		.delivery-banner
		{
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 0.5rem;
			background-color: #353535;
			color: #fff;

			span
			{
				font-weight: 500;
			}

			svg
			{
				width: 4rem;
				height: auto;
				stroke-width: 1;
			}
		}

		.delivery-date
		{
			margin-bottom: 1rem;
			text-align: center;

			time
			{
				font-weight: 500;
			}
		}

		.delivery-advice
		{
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 0;
			margin: 0 1rem;
			padding: 1rem 3rem;
			background-color: #f3f5f5;

			svg
			{
				width: 4rem;
				height: auto;
				color: #fa253c;
			}

			p
			{
				text-align: center;
				font-size: 0.8rem;
			}
		}

		{{-- Products --}}

		.table-wrapper
		{
			margin: 1.5rem 1rem 1rem;
		}

		.products-table
		{
			width: 100%;
			border-collapse: collapse;
			font-size: 0.8rem;

			thead tr
			{
				background-color: #f3f5f5;

				th
				{
					padding: 0.2rem;
					font-weight: 500;
				}
			}

			tbody td
			{
				padding: 0.2rem;

				&:first-child
				{
					padding-left: 0;
					display: flex;
					align-items: center;
					gap: 0.5rem;
					text-align: left;
				}

				img
				{
					width: 3rem;
					height: auto;
				}

				&:last-child
				{
					text-align: right;
				}
			}

			tfoot
			{
				margin-top: 0.5rem;

				tr td
				{
					padding: 0.5rem 0.2rem;

					&:last-child
					{
						text-align: right;
						opacity: 0.6;
					}
				}

				tr:last-child td
				{
					padding: 0.5rem 0.2rem;

					&[colspan="2"]
					{
						text-transform: uppercase;
						color: #9143bc;
						font-weight: 700;
						letter-spacing: 0.01rem;
					}

					&:last-child
					{
						opacity: 1;
					}
				}
			}
		}

		{{-- Help --}}

		.help
		{
			> h2
			{
				color: #9143bc;
				text-transform: none;
				letter-spacing: normal;
			}

			> div
			{
				display: grid;
				grid-template-columns: repeat(2, minmax(0, 1fr));
				gap: 1rem;
				margin-bottom: 1rem;
				color: #fff;

				> div
				{
					display: flex;
					align-items: center;
					gap: 0.5rem;
					padding: 0.2rem 1rem;
					background-color: #9143bc;
				}

				svg
				{
					flex-grow: 0;
					flex-shrink: 0;
					width: 3rem;
					height: auto;
				}

				p
				{
					text-align: center;

					span
					{
						font-size: 0.8rem;
					}
				}
			}
		}
	</style>
@endsection

@section('content')
	<div class="order-text-block">
		<div>
			<p style="font-size: 1.5rem">Hola {{ $order->first_name }}</p>
			<h1>¡Tu compra fue confirmada!</h1>
			<div class="text">
				<p>Queremos informarte que tu pedido N&ordm; {{ $order->number }} fue confirmado satisfactoriamente.</p>
			</div>
		</div>
		<div>
			<x-icons.shopping-bag />
		</div>
	</div>
	{{-- Order status --}}
	<div>
		<h2>Estado de tu pedido</h2>
		<div class="order-steps">
			<div class="cart-step current">
				<a href="#">
				<span class="marker">
					<x-icons.arrow-path />
				</span>
					Recibido
				</a>
			</div>
			<div class="cart-step current">
				<a href="#">
				<span class="marker">
					<x-icons.shopping-bag />
				</span>
					Confirmado
				</a>
			</div>
			<div class="cart-step">
				<a href="#">
				<span class="marker">
					<x-icons.truck />
				</span>
					En camino
				</a>
			</div>
			<div class="cart-step">
				<a href="#">
				<span class="marker">
					<x-icons.package />
				</span>
					Entregado
				</a>
			</div>
		</div>
	</div>
	{{-- Order info --}}
	<div>
		{{-- Resume --}}
		<div>
			<h2>Resumen de tu pedido</h2>
			<div class="resume-table">
				<div>
					<p>Nombre del titular:<br /><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
					<p>Documento de identidad:<br /><strong>DNI {{ $order->id_document_number }}</strong></p>
				</div>
				<div>
					<p>Número de pedido:<br /><strong>{{ $order->number }}</strong></p>
					<p>Fecha de compra:<br /><strong>{{ $order->created_at->toDateString() }}</strong></p>
				</div>
			</div>
		</div>
		{{-- Payment --}}
		<section>
			<h2>Detalles de tu pago</h2>
			<div>
				{{-- Payment method --}}
				<div class="total-row">
					<div>Medio de pago:</div>
					<div>{{ $order->payment_method_type->getLabel() }}</div>
				</div>
				{{-- Subtotal --}}
				<div class="total-row even">
					<div>Subtotal:</div>
					<div>S/&nbsp;{{ number_format($order->subtotal, 2) }}</div>
				</div>
				{{-- Delivery price --}}
				<div class="total-row">
					<div>Envío:</div>
					<div>S/&nbsp;{{ number_format($order->delivery_price, 2) }}</div>
				</div>
				{{-- Discounts --}}
				<div class="total-row even">
					<div>Descuentos:</div>
					<div>S/&nbsp;{{ number_format(0, 2) }}</div>
				</div>
				{{-- Total --}}
				<div class="total-row total">
					<div>Total:</div>
					<div>S/&nbsp;{{ number_format($order->total, 2) }}</div>
				</div>
			</div>
		</section>
		{{-- Delivery --}}
		<section>
			<div class="delivery-banner">
				<p>Productos con <span>despacho a domicilio</span></p>
				<x-icons.truck />
			</div>
			<div>
				<h2>Datos de la entrega</h2>
				<p class="delivery-date">Fecha de entrega aprox.: <time datetime="{{ $order->delivery_date->toDateString() }}">{{ $order->delivery_date->toDateString() }}</time></p>
				<div class="delivery-advice">
					<x-icons.exclamation-circle />
					<p>Te enviaremos un correo electrónico y/o WhatsApp cuando tu pedido se encuentre en camino.</p>
				</div>
				<div class="resume-table">
					<div>
						<p>Persona autorizada para recibir el pedido:<br /><strong>{{ $order->recipient_name }}</strong></p>
						<p>&nbsp;</p>
					</div>
					<div>
						<p>Dirección de entrega:<br /><strong>{{ $order->address }} {{ $order->location_number }}<br />{{ $order->district_name }} - {{ $order->province_name }} - {{ $order->department_name }}</strong></p>
						<p>Horario de despacho:<br /><strong>08:00&nbsp;AM a 08:00&nbsp;PM</strong></p>
					</div>
				</div>
				{{-- Products --}}
				<div class="table-wrapper">
					<table class="products-table">
						<thead>
						<tr>
							<th>Productos</th>
							<th>UM</th>
							<th>Cantidad</th>
							<th>Precio</th>
						</tr>
						</thead>
						<tbody>
						@foreach($order->items as $item)
							<tr>
								<td>
									<img src="{{ (new \App\Services\UrlService())->fromAsset($item->book->cover_or_placeholder) }}" alt="{{ $item->book->title }}" />
									{{ $item->book->title }}
								</td>
								<td>Un</td>
								<td>{{ $item->quantity }}</td>
								<td>S/&nbsp;{{ number_format($item->subtotal, 2) }}</td>
							</tr>
						@endforeach
						</tbody>
						<tfoot>
						<tr>
							<td></td>
							<td colspan="2">Envío</td>
							<td>S/&nbsp;{{ number_format($order->delivery_price, 2) }}</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2">Subtotal</td>
							<td>S/&nbsp;{{ number_format($order->subtotal, 2) }}</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2">Descuentos</td>
							<td>S/&nbsp;{{ number_format($order->discount, 2) }}</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2">Total</td>
							<td>S/&nbsp;{{ number_format($order->total, 2) }}</td>
						</tr>
						</tfoot>
					</table>
				</div>
				<section class="help">
					<h2>¿Necesitas ayuda?</h2>
					<div>
						<div>
							<x-icons.envelope />
							<p>Escríbenos,<br /><span>estamos para ayudarte ventas@perselibrerias.com.pe</span></p>
						</div>
						<div>
							<x-icons.headset />
							<p>Llámanos al<br /><span>(01) 960&nbsp;155&nbsp;037<br />de lunes a domingo de 8am a 8pm</span></p>
						</div>
					</div>
				</section>
			</div>
		</section>
	</div>
@endsection
