<div class="flex flex-col gap-6">
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.user />
				Datos Personales
				<div class="completed-step">
					<x-icons.check-circle />
				</div>
			</h2>
		</div>
		<div class="card-body">
			<div class="flex justify-between">
				<ul>
					<li><strong>Correo:</strong> {{ $email }}</li>
					<li><strong>Nombres:</strong> {{ $firstName }}</li>
					<li><strong>Apellidos:</strong> {{ $lastName }}</li>
					<li><strong>Documento de Identidad:</strong> {{ $identityDocumentNumber }}</li>
					<li><strong>Teléfono / Móvil:</strong> {{ $phone }}</li>
					<li><strong>Deseo:</strong> {{ $invoiceType->name }}</li>
					@if($invoiceType == \App\InvoiceType::Factura)
						<li><strong>RUC:</strong> {{ $ruc }}</li>
						<li><strong>Razón Social:</strong> {{ $businessName }}</li>
					@endif
				</ul>
				<div>
					<button type="button" wire:click="goToPersonalInfo" class="action-button" title="Editar">
						<x-icons.pencil-square class="size-6 mx-auto" />
						<span class="sr-only">Editar</span>
					</button>
				</div>
			</div>
		</div>
	</x-cart-card>
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.truck />
				Detalle de Entrega
				<div class="completed-step">
					<x-icons.check-circle />
				</div>
			</h2>
		</div>
		<div class="card-body">
			<div class="flex justify-between">
				<div>
					<p class="mb-4">
						<strong>Dirección:</strong><br />
						{{ $address }} {{ $locationNumber }}
						@if($reference)
							<br />{{ $reference }}
						@endif
					</p>
					@if($recipientName)
						<p class="mb-4">
							<strong>Destinatario:</strong> {{ $recipientName }}
						</p>
					@endif
					<p>
						<strong>Fecha de entrega:</strong><br />
						{{ ucfirst(\Carbon\Carbon::parse($deliveryDate)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY')) }}<br />
						<strong>Horario:</strong> De 8:00 a 20:00
					</p>
				</div>
				<div>
					<button type="button" wire:click="goToDeliveryInfo" class="action-button" title="Editar">
						<x-icons.pencil-square class="size-6 mx-auto" />
						<span class="sr-only">Editar</span>
					</button>
				</div>
			</div>
		</div>
	</x-cart-card>
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.credit-card />
				Método de Pago
			</h2>
		</div>
		<div class="card-body">
			<ul class="space-y-4">
				<li>
					<div class="flex items-center justify-between rounded border border-gray-500 p-6">
						<div class="checkbox-wrapper">
							<input type="radio" wire:model="paymentMethod" checked="checked" value="{{ \App\PaymentMethodType::CreditOrDebitCard }}" id="payment-method-1" name="payment-method" class="accent-palette-orange" />
							<label for="payment-method-1" class="font-[500]">Tarjeta débito o crédito</label>
						</div>
						<div>
							<img src="{{ asset('images/credit-cards.png') }}" alt="Visa, MasterCard, American Express y Diners Club" />
						</div>
					</div>
					<form class="delivery-form xl:px-32 pt-4">
						<div class="form-control-wrapper">
							<label for="card-number">Número</label>
							<input type="text" id="card-number" />
						</div>
						<div class="form-control-wrapper w-1/2">
							<label for="card-number">Cuotas disponibles</label>
							<input type="text" id="card-number" value="Total - S/ 261.91" />
						</div>
						<div class="form-control-wrapper">
							<label for="card-number">Nombre y apellido como figura en la tarjeta</label>
							<input type="text" id="card-number" />
						</div>
						<div class="flex items-center justify-between">
							<div class="form-control-wrapper-inline">
								<label for="input-due_month">Fecha de Vencimiento</label>
								<div class="flex items-center gap-1">
									<input id="input-due_month" placeholder="MM" maxlength="2" class="w-12 text-center" />
									<span>/</span>
									<input id="input-due_year" placeholder="AA" maxlength="2" class="w-12 text-center" />
								</div>
							</div>
							<div class="form-control-wrapper-inline">
								<label for="input-cvv">Código de Seguridad</label>
								<input id="input-cvv" maxlength="3" class="w-12" />
							</div>
						</div>
						<div class="form-control-wrapper">
							<label for="card-number">Documento de identidad del pagador</label>
							<input type="text" id="card-number" />
						</div>
						<div class="checkbox-wrapper">
							<input type="checkbox" />
							<label>La dirección de la factura de la tarjeta es <strong>{{ $address }} {{ $locationNumber }}</strong></label>
						</div>
					</form>
				</li>
				<li class="flex items-center justify-between rounded border border-gray-500 p-6">
					<div class="checkbox-wrapper">
						<input type="radio" wire:model="paymentMethod" value="{{ \App\PaymentMethodType::QrCode }}" id="payment-method-2" name="payment-method" class="accent-palette-orange" />
						<label for="payment-method-2" class="font-[500]">Plin/Yape</label>
					</div>
					<div>
						<img src="{{ asset('images/plin-yape.png') }}" alt="Plin y Yape" />
					</div>
				</li>
				<li class="flex items-center justify-between rounded border border-gray-500 p-6">
					<div class="checkbox-wrapper">
						<input type="radio" wire:model="paymentMethod" value="{{ \App\PaymentMethodType::PagoEfectivo }}" id="payment-method-3" name="payment-method" class="accent-palette-orange" />
						<label for="payment-method-3" class="font-[500]">PagoEfectivo</label>
					</div>
					<div>
						<img src="{{ asset('images/pago-efectivo.png') }}" alt="PagoEfectivo" />
					</div>
				</li>
			</ul>
		</div>
	</x-cart-card>
</div>
