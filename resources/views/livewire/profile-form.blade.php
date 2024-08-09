<form wire:submit="saveForm">
	<div class="profile-form-body">
		<div>
			<div class="grid-inner-cols">
				<div>
					<label for="input-first_name">Nombres</label>
					@if($isEditable)
						<input type="text" wire:model="firstName" id="input-first_name" required="required" class="form-control" />
					@else
						<div class="readonly">{{ $firstName }}</div>
					@endif
				</div>
				<div>
					<label for="input-last_name">Apellidos</label>
					@if($isEditable)
						<input type="text" wire:model="lastName" id="input-last_name" required="required" class="form-control" />
					@else
						<div class="readonly">{{ $lastName }}</div>
					@endif
				</div>
				<div>
					<label for="input-email">Email</label>
					@if($isEditable)
						<input type="email" wire:model="email" id="input-email" required="required" class="form-control" />
					@else
						<div class="readonly">{{ $email }}</div>
					@endif
				</div>
				<div>
					<label for="input-phone">Celular</label>
					@if($isEditable)
						<input type="tel" wire:model="phone" id="input-phone" required="required" class="form-control" />
					@else
						<div class="readonly">{{ $phone }}</div>
					@endif
				</div>
				<div>
					<label for="input-birthdate">Fecha de nacimiento</label>
					@if($isEditable)
						<input type="date" wire:model="birthdate" id="input-birthdate" required="required" class="form-control" />
					@else
						<div class="readonly">{{ $birthdate }}</div>
					@endif
				</div>
				<div>
					<label for="input-id_document_number">Documento de identidad</label>
					@if($isEditable)
						<input type="text" wire:model="idDocumentNumber" id="input-id_document_number" required="required" class="form-control" />
					@else
						<div class="readonly">{{ $idDocumentNumber }}</div>
					@endif
				</div>
				<div>
					<label for="input-gender">Género</label>
					@if($isEditable)
						<select wire:model="gender" class="form-control" required="required">
							<option value="">Selecciona una opción</option>
							@foreach(\App\Gender::cases() as $item)
								<option value="{{ $item->value }}">{{ $item->getLabel() }}</option>
							@endforeach
						</select>
					@else
						<div class="readonly">{{ $gender->getLabel() }}</div>
					@endif
				</div>
			</div>
		</div>
		<div>
			@if($isEditable)
				<input type="checkbox" wire:model="isSubscribed" id="input-is_subscribed" />
				<label for="input-is_subscribed">Deseo recibir promociones y novedades de Persé Librerías</label>
			@else
				{{ $isSubscribed ? 'Deseo' : 'No deseo' }} recibir promociones y novedades de Persé Librerías
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
