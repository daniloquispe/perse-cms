<div class="w-full">
	<div class="mx-6 py-4 flex items-center border-b border-gray-200 text-gray-500">
		<div class="grow px-4">
			<address class="not-italic">
				{{ $address->address }} {{ $address->location_number }}
				<br />{{ $address->district_name }}, {{ $address->province_name }}, {{ $address->department_name }}
				@if($address->reference)
					<br />Referencia: {{ $address->reference }}
				@endif
			</address>
		</div>
		<div class="grow-0">
			<button type="button" wire:click="toggleEditForm" title="Editar" class="action-button">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
				</svg>
			</button>
		</div>
	</div>
	@if($showEditForm)
		<div wire:transition.opacity class="mx-6 py-4">
			<form wire:submit="submit" class="customer-form px-4">
				<div class="sm:grid sm:grid-cols-3 sm:gap-4">
					<div class="form-control-wrapper">
						<label>Departamento</label>
						<select wire:model="form.departmentId" wire:change="loadProvinces" required="required" class="form-control">
							<option value="">--</option>
							@foreach($departments as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
						@error('form.departmentId')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-control-wrapper">
						<label>Provincia</label>
						<select wire:model="form.provinceId" wire:change="loadDistricts" required="required" class="form-control">
							<option value="">--</option>
							@foreach($provinces as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
						@error('form.provinceId')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-control-wrapper">
						<label>Distrito</label>
						<select wire:model="form.districtId" required="required" class="form-control">
							<option value="">--</option>
							@foreach($districts as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
						@error('form.districtId')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-control-wrapper">
					<label>Dirección de la calle</label>
					<input type="text" wire:model="form.address" required="required" class="form-control" />
					@error('form.address')
						<div class="form-error">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-control-wrapper">
					<label>Número de la dirección</label>
					<input type="text" wire:model="form.locationNumber" required="required" class="form-control" />
					@error('form.locationNumber')
						<div class="form-error">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-control-wrapper">
					<label>Referencia</label>
					<input type="text" wire:model="form.reference" class="form-control" />
					@error('form.reference')
						<div class="form-error">{{ $message }}</div>
					@enderror
				</div>
				<div class="buttonbar mt-8">
					<button type="submit">Guardar cambios</button>
				</div>
			</form>
		</div>
	@endif
</div>
