<x-customer-card title="Direcciones" :has-body="false">
	@foreach([1 => 'Address 1', 'Address 2', 'Address 3'] as $id => $address)
		<div class="w-full">
			<div class="mx-6 py-4 flex items-center border-b border-gray-200 text-gray-500">
				<div class="grow px-4">{{ $address }}</div>
				<div class="grow-0">
					<button type="button" wire:click="showEditForm({{ $id }})" title="Editar" class="action-button">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
						</svg>
					</button>
				</div>
			</div>
			@if($this->addressIdToEdit == $id)
				<div wire:transition.opacity class="mx-6 py-4">
					<form wire:submit="submitEditForm" class="customer-form px-4">
						<div class="sm:grid sm:grid-cols-3 sm:gap-4">
							<div class="form-control-wrapper">
								<label>Departamento</label>
								<select required="required" class="form-control">
									<option value="">--</option>
								</select>
							</div>
							<div class="form-control-wrapper">
								<label>Provincia</label>
								<select required="required" class="form-control">
									<option value="">--</option>
								</select>
							</div>
							<div class="form-control-wrapper">
								<label>Distrito</label>
								<select required="required" class="form-control">
									<option value="">--</option>
								</select>
							</div>
						</div>
						<div class="form-control-wrapper">
							<label>Dirección de la calle</label>
							<input type="text" value="{{ $address }}" class="form-control" />
						</div>
						<div class="form-control-wrapper">
							<label>Número de la dirección</label>
							<input type="text" class="form-control" />
						</div>
						<div class="form-control-wrapper">
							<label>Referencia</label>
							<input type="text" class="form-control" />
						</div>
					</form>
				</div>
			@endif
		</div>
	@endforeach
</x-customer-card>
