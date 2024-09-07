<div class="flex flex-col gap-10">
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
			Info and edit!
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
				<button type="submit" class="next-sub-step-button">Ir para la Entrega</button>
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
