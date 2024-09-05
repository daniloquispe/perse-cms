<div class="flex flex-col gap-10">
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.user />
				Datos Personales
			</h2>
		</div>
		<div class="card-body">
			<form class="delivery-form">
				{{-- E-mail --}}
				<div class="form-control-wrapper">
					<label for="input-email">Correo</label>
					<input type="email" wire:model="email" id="input-email" required="required" />
				</div>
				<div class="grid grid-cols-2 gap-4">
					{{-- First name --}}
					<div class="form-control-wrapper">
						<label for="input-first_name">Nombre</label>
						<input type="text" wire:model="firstName" id="input-first_name" required="required" />
					</div>
					{{-- Last name --}}
					<div class="form-control-wrapper">
						<label for="input-last_name">Apellidos</label>
						<input type="text" wire:model="lastName" id="input-last_name" required="required" />
					</div>
				</div>
				<div class="grid grid-cols-2 gap-4">
					{{-- Identity document --}}
					<div class="form-control-wrapper">
						<label for="input-document_identity_number">Documento de identidad</label>
						<input type="text" wire:model="documentIdentityNumber" id="input-document_identity_number" required="required" />
					</div>
					{{-- Phone --}}
					<div class="form-control-wrapper">
						<label for="input-phone">Teléfono / Móvil</label>
						<input type="tel" wire:model="phone" id="input-phone" required="required" />
					</div>
				</div>
				<div>
					{{-- Subscribe --}}
					<div class="checkbox-wrapper">
						<input type="radio" wire:model="withSubscription" name="with_invoice" id="input-with_subscription" required="required" />
						<div>
							<label for="input-with_subscription">Deseo Boleta</label>
							@error('withSubscription')
							<div class="form-error">{{ $message }}</div>
							@enderror
						</div>
					</div>
					{{-- Invoice --}}
					<div class="checkbox-wrapper">
						<input type="radio" wire:model="withInvoice" wire:change="toggleInvoiceFields" name="with_invoice" id="input-with_invoice" required="required" />
						<div>
							<label for="input-with_invoice">Deseo Factura</label>
							@error('withInvoice')
							<div class="form-error">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>
				{{-- Invoice info --}}
				@if($showInvoiceFields)
					<div wire:transition.opacity class="mt-4">
						<div class="grid grid-cols-2 gap-4">
							{{-- Identity document --}}
							<div class="form-control-wrapper">
								<label for="input-ruc">RUC</label>
								<input type="text" wire:model="ruc" id="input-ruc" required="required" />
							</div>
							{{-- Business name --}}
							<div class="form-control-wrapper">
								<label for="input-phone">Razón Social</label>
								<input type="text" wire:model="businessName" id="input-phone" required="required" />
							</div>
						</div>
					</div>
				@endif
				<button type="button" wire:click="toggleAddressForm" class="next-sub-step-button">Ir para la Entrega</button>
			</form>
		</div>
	</x-cart-card>
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.truck />
				Detalle de Entrega
			</h2>
		</div>
		@if($showAddressForm)
			<div wire:transition.opacity class="card-body">
				<form class="delivery-form">
					<div class="grid grid-cols-3 gap-4">
						{{-- Department --}}
						<div class="form-control-wrapper">
							<label>Departamento</label>
							<select wire:model="departmentId" wire:change="loadProvinces" required="required">
								<option>--</option>
								@foreach($departments as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
								@endforeach
							</select>
						</div>
						{{-- Province --}}
						<div class="form-control-wrapper">
							<label>Provincia</label>
							<select wire:model="provinceId" wire:change="loadDistricts" required="required">
								<option>--</option>
								@foreach($provinces as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
								@endforeach
							</select>
						</div>
						{{-- District --}}
						<div class="form-control-wrapper">
							<label>Distrito</label>
							<select wire:model="districtId" required="required">
								<option>--</option>
								@foreach($districts as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					{{-- Address --}}
					<div class="form-control-wrapper">
						<label>Dirección de la calle</label>
						<input type="text" />
					</div>
				</form>
			</div>
		@endif
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
