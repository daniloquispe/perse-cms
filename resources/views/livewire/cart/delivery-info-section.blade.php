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
					@if(config('services.erp.enable'))
						<li><strong>Deseo:</strong> {{ $invoiceType->name }}</li>
						@if($invoiceType == \App\InvoiceType::Factura)
							<li><strong>RUC:</strong> {{ $ruc }}</li>
							<li><strong>Razón Social:</strong> {{ $businessName }}</li>
						@endif
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
			</h2>
		</div>
		<div class="card-body">
			<form wire:submit="submitForm" class="delivery-form">
				@if($lastAddress)
					<div class="flex justify-between form-control-wrapper">
						<div>
							<p><strong>Dirección:</strong></p>
							<address>
								{{ $lastAddress->address }} {{ $lastAddress->location_number }}
								<br />{{ $lastAddress->district_name }}, {{ $lastAddress->province_name }}, {{ $lastAddress->department_name }}
								@if($lastAddress->reference)
									<br />Referencia: {{ $lastAddress->reference }}
								@endif
							</address>
						</div>
						<div>
							<button type="button" wire:click="showAddressFields" class="action-button" title="Editar">
								<x-icons.pencil-square class="size-6 mx-auto" />
								<span class="sr-only">Editar</span>
							</button>
						</div>
					</div>
				@else
					<div class="sm:grid sm:grid-cols-3 sm:gap-4">
						{{-- Department --}}
						<div class="form-control-wrapper">
							<label>Departamento</label>
							<select wire:model="form.departmentId" wire:change="loadProvinces" required="required">
								<option value="">--</option>
								@foreach($departments as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
								@endforeach
							</select>
						</div>
						{{-- Province --}}
						<div class="form-control-wrapper">
							<label>Provincia</label>
							<select wire:model="form.provinceId" wire:change="loadDistricts" @disabled($cannotSelectProvince) required="required">
								<option value="">--</option>
								@foreach($provinces as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
								@endforeach
							</select>
						</div>
						{{-- District --}}
						<div class="form-control-wrapper">
							<label>Distrito</label>
							<select wire:model="form.districtId" wire:change="calculateDeliveryPrice" @disabled($cannotSelectDistrict) required="required">
								<option value="">--</option>
								@foreach($districts as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					{{-- Address --}}
					<div class="form-control-wrapper">
						<label>Dirección</label>
						<input type="text" wire:model="form.address" required="required" />
					</div>
					{{-- Location number --}}
					<div class="form-control-wrapper">
						<label>Número de la dirección</label>
						<input type="text" wire:model="form.locationNumber" required="required" />
					</div>
					{{-- Reference --}}
					<div class="form-control-wrapper">
						<label>Referencia</label>
						<input type="text" wire:model="form.reference" />
					</div>
				@endif
				{{-- Destinatario --}}
				<div class="form-control-wrapper">
					<label>Persona autorizada para recibir el pedido</label>
					<input type="text" wire:model="form.recipientName" />
				</div>
				<div class="sm:grid sm:grid-cols-3 sm:gap-4">
					{{-- Delivery method --}}
					<div class="form-control-wrapper">
						<label>Método de entrega</label>
						<div class="h-24 p-6 flex items-center justify-center gap-2 border border-gray-400 rounded">
							<img src="{{ asset('images/delivery.png') }}" alt="" class="size-16" />
							<span>Entrega a domicilio</span>
						</div>
					</div>
					{{-- Delivery date --}}
					<div class="form-control-wrapper col-span-2">
						<label>Fecha de entrega</label>
						<div class="h-24 p-6 flex items-center justify-between gap-2 border border-gray-400 rounded">
							@if($isDeliveryDateFieldVisible)
								<input type="date" wire:model="form.deliveryDate" wire:blur="hideDeliveryDateField" min="{{ $this->minDeliveryDate }}" />
							@elseif($form->deliveryDate)
								<ul>
									<li>
										<strong>Fecha:</strong>
										{{ ucfirst(\Carbon\Carbon::parse($form->deliveryDate)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY')) }}
										<button type="button" wire:click="showDeliveryDateField" title="Cambiar fecha">
											<x-icons.chevron-down class="size-4" aria-label="Cambiar fecha" />
										</button>
									</li>
									<li><strong>Hora:</strong> De 08:00 a 20:00</li>
								</ul>
								<div>
									@if($deliveryPrice)
										S/&nbsp;{{ number_format($deliveryPrice, 2) }}
									@else
										Por calcular
									@endif
								</div>
							@else
								<div>Elija una fecha de entrega</div>
								<div>
									<button type="button" wire:click="showDeliveryDateField" class="action-button" title="Elija una fecha">
										<x-icons.calendar class="size-6 mx-auto" />
										<span class="sr-only">Elegir fecha</span>
									</button>
								</div>
							@endif
						</div>
					</div>
				</div>
				<button type="submit" class="next-sub-step-button">Ir para el Pago</button>
			</form>
		</div>
	</x-cart-card>
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.credit-card />
				Método de Pago
			</h2>
		</div>
	</x-cart-card>
</div>
