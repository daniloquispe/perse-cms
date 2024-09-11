<div class="flex flex-col gap-10">
	<x-cart-card class="row-span-2">
		<div class="card-header">
			<h2 class="card-title">
				<x-icons.user />
				Datos Personales
			</h2>
		</div>
		<div class="card-body">
			<form wire:submit="submitForm" class="delivery-form">
				{{-- E-mail --}}
				<div class="form-control-wrapper">
					<label for="input-email">Correo</label>
					<input type="email" wire:model="form.email" id="input-email" required="required" />
					@error('form.email')
						<div class="form-error">{{ $message }}</div>
					@enderror
				</div>
				<div class="grid grid-cols-2 gap-4">
					{{-- First name --}}
					<div class="form-control-wrapper">
						<label for="input-first_name">Nombre</label>
						<input type="text" wire:model="form.firstName" id="input-first_name" required="required" />
						@error('form.firstName')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
					{{-- Last name --}}
					<div class="form-control-wrapper">
						<label for="input-last_name">Apellidos</label>
						<input type="text" wire:model="form.lastName" id="input-last_name" required="required" />
						@error('form.lastName')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="grid grid-cols-2 gap-4">
					{{-- Identity document --}}
					<div class="form-control-wrapper">
						<label for="input-document_identity_number">Documento de identidad</label>
						<input type="text" wire:model="form.identityDocumentNumber" id="input-document_identity_number" required="required" />
						@error('form.identityDocumentNumber')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
					{{-- Phone --}}
					<div class="form-control-wrapper">
						<label for="input-phone">Teléfono / Móvil</label>
						<input type="tel" wire:model="form.phone" id="input-phone" required="required" />
						@error('form.phone')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div>
					{{-- Invoice type --}}
					<div class="checkbox-wrapper">
						<input type="radio" wire:model="form.invoiceType" wire:change="toggleInvoiceFields" name="invoice_type" value="3" id="input-invoice_type-3" />
						<div>
							<label for="input-invoice_type-3">Deseo Boleta</label>
						</div>
					</div>
					{{-- Invoice --}}
					<div class="checkbox-wrapper">
						<input type="radio" wire:model="form.invoiceType" wire:change="toggleInvoiceFields" name="invoice_type" value="1" id="input-invoice_type-1" />
						<div>
							<label for="input-invoice_type-1">Deseo Factura</label>
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
								<input type="text" wire:model="form.ruc" id="input-ruc" required="required" />
								@error('form.ruc')
									<div class="form-error">{{ $message }}</div>
								@enderror
							</div>
							{{-- Business name --}}
							<div class="form-control-wrapper">
								<label for="input-business_name">Razón Social</label>
								<input type="text" wire:model="form.businessName" id="input-business_name" required="required" />
								@error('form.businessName')
									<div class="form-error">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
				@endif
				<button type="submit" class="next-sub-step-button">Ir para la Entrega</button>
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
