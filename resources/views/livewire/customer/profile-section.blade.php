<div class="card">
	<div class="card-header">
		<p class="card-title">Perfil</p>
	</div>
	<div class="card-body">
		<form wire:submit="saveForm">
			<div class="profile-form-body">
				<div>
					<div class="grid-inner-cols">
						<div>
							<label for="input-first_name">Nombres</label>
							@if($isEditable)
								<input type="text" wire:model="form.first_name" id="input-first_name" required="required" class="form-control" />
								@error('form.first_name')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->first_name }}</div>
							@endif
						</div>
						<div>
							<label for="input-last_name">Apellidos</label>
							@if($isEditable)
								<input type="text" wire:model="form.last_name" id="input-last_name" required="required" class="form-control" />
								@error('form.last_name')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->last_name }}</div>
							@endif
						</div>
						<div>
							<label for="input-email">Email</label>
							@if($isEditable)
								<input type="email" wire:model="form.email" id="input-email" required="required" class="form-control" />
								@error('form.email')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->email }}</div>
							@endif
						</div>
						<div>
							<label for="input-phone">Celular</label>
							@if($isEditable)
								<input type="tel" wire:model="form.phone" id="input-phone" required="required" class="form-control" />
								@error('form.phone')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->phone }}</div>
							@endif
						</div>
						<div>
							<label for="input-birthdate">Fecha de nacimiento</label>
							@if($isEditable)
								<input type="date" wire:model="form.birthdate" id="input-birthdate" required="required" class="form-control" />
								@error('form.birthdate')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->birthdate }}</div>
							@endif
						</div>
						<div>
							<label for="input-id_document_number">Documento de identidad</label>
							@if($isEditable)
								<input type="text" wire:model="form.id_document_number" id="input-id_document_number" required="required" class="form-control" />
								@error('form.id_document_number')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->id_document_number }}</div>
							@endif
						</div>
						<div>
							<label for="input-gender">Género</label>
							@if($isEditable)
								<select wire:model="form.gender" class="form-control" required="required">
									<option value="">Selecciona una opción</option>
									@foreach(\App\Gender::cases() as $item)
										<option value="{{ $item->value }}">{{ $item->getLabel() }}</option>
									@endforeach
								</select>
								@error('form.gender')
									<div class="form-error">{{ $message }}</div>
								@enderror
							@else
								<div class="readonly">{{ $form->gender?->getLabel() }}</div>
							@endif
						</div>
					</div>
				</div>
				<div>
					@if($isEditable)
						<input type="checkbox" wire:model="form.is_subscribed" id="input-is_subscribed" />
						<label for="input-is_subscribed">Deseo recibir promociones y novedades de Persé Librerías</label>
					@else
						{{ $form->is_subscribed ? 'Deseo' : 'No deseo' }} recibir promociones y novedades de Persé Librerías
					@endif
				</div>
			</div>
			<div class="buttonbar">
				@if($isEditable)
					<button type="submit">Guardar perfil</button>
				@else
					<button type="button" wire:click="makeEditable">Editar</button>
				@endif
			</div>
		</form>
	</div>
</div>
