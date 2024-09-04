<div class="grid grid-cols-12 gap-8">
	<div class="col-span-8 row-span-2">
		<x-cart-card class="row-span-2">
			<div class="card-header">
				<h2 class="card-title">
					<x-icons.cart />
					Carro de Compras
				</h2>
			</div>
			<div class="card-body">
				{{-- E-mail --}}
				<div class="mb-4">
					<label for="input-email">Correo</label>
					<input type="email" wire:model="email" id="input-email" required="required" />
				</div>
				<div class="grid grid-cols-2 gap-4">
					{{-- First name --}}
					<div class="mb-4">
						<label for="input-first_name">Nombre</label>
						<input type="text" wire:model="firstName" id="input-first_name" required="required" />
					</div>
					{{-- Last name --}}
					<div class="mb-4">
						<label for="input-last_name">Apellidos</label>
						<input type="text" wire:model="lastName" id="input-last_name" required="required" />
					</div>
				</div>
				<div class="grid grid-cols-2 gap-4">
					{{-- Identity document --}}
					<div class="mb-4">
						<label for="input-document_identity_number">Documento de identidad</label>
						<input type="text" wire:model="documentIdentityNumber" id="input-document_identity_number" required="required" />
					</div>
					{{-- Phone --}}
					<div class="mb-4">
						<label for="input-phone">Teléfono / Móvil</label>
						<input type="tel" wire:model="phone" id="input-phone" required="required" />
					</div>
				</div>
				<div>
					{{-- Subscribe --}}
					<div class="checkbox-wrapper">
						<input type="checkbox" wire:model="withSubscription" id="input-with_subscription" required="required" />
						<div>
							<label for="input-with_subscription">Deseo News</label>
							@error('withSubscription')
								<div class="form-error">{{ $message }}</div>
							@enderror
						</div>
					</div>
					{{-- Invoice --}}
					<div class="checkbox-wrapper">
						<input type="checkbox" wire:model="withInvoice" wire:change="toggleInvoiceFields" id="input-with_invoice" required="required" />
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
					<div wire:transition.opacity>
						<div class="grid grid-cols-2 gap-4">
							{{-- Identity document --}}
							<div class="mb-4">
								<label for="input-ruc">RUC</label>
								<input type="text" wire:model="ruc" id="input-ruc" required="required" />
							</div>
							{{-- Business name --}}
							<div class="mb-4">
								<label for="input-phone">Razón Social</label>
								<input type="text" wire:model="businessName" id="input-phone" required="required" />
							</div>
						</div>
					</div>
				@endif
			</div>
		</x-cart-card>
		<x-cart-card class="row-span-2">
			<div class="card-header">
				<h2 class="card-title">
					<x-icons.cart />
					Carro de Compras
				</h2>
			</div>
			<div class="card-body">
				<div class="grid grid-cols-3 gap-4">
					{{-- Department --}}
					<div class="mb-4">
						<label>Departamento</label>
						<select wire:model="departmentId" wire:change="loadProvinces" required="required">
							<option>--</option>
							@foreach($departments as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
					</div>
					{{-- Province --}}
					<div class="mb-4">
						<label>Provincia</label>
						<select wire:model="provinceId" wire:change="loadDistricts" required="required">
							<option>--</option>
							@foreach($provinces as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
					</div>
					{{-- District --}}
					<div class="mb-4">
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
				<div class="mb-4">
					<label>Dirección de la calle</label>
					<input type="text" />
				</div>
			</div>
		</x-cart-card>
		<x-cart-card class="row-span-2">
			<div class="card-header">
				<h2 class="card-title">
					<x-icons.cart />
					Carro de Compras
				</h2>
			</div>
			<div class="card-body"></div>
		</x-cart-card>
	</div>
	<div class="col-span-4">
		<x-cart-card>
			<div class="card-body">
				{{-- Coupon --}}
				<h2 class="section-title">Valida tu cupón</h2>
				<form class="coupon-form">
					<input placeholder="Código de cupón" required="required" aria-label="Código de cupón" />
					<button type="submit">Validar</button>
				</form>
			</div>
		</x-cart-card>
	</div>
</div>
