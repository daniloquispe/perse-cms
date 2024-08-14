<form wire:submit="subscribe">
	{{-- Name --}}
	<div class="form-row">
		<input type="text" wire:model="name" placeholder="Tu nombre *" required="required" aria-label="Tu nombre" />
		@error('name')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- E-mail --}}
	<div class="form-row">
		<input type="email" wire:model="email" placeholder="Correo electrónico *" required="required" aria-label="Correo electrónico" />
		@error('email')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- Phone --}}
	<div class="form-row">
		<input type="tel" wire:model="phone" placeholder="Teléfono" required="required" aria-label="Teléfono" />
		@error('phone')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- Categories --}}
	<fieldset class="form-row">
		<legend>Selecciona tus categorías favoritas</legend>
		<div class="form-row">
			<select wire:model="category_id_1" required="required">
				<option value="">Categoría Opción 1</option>
				@foreach($topCategories as $id => $name)
					<option value="{{ $id }}">{{ $name }}</option>
				@endforeach
			</select>
			@error('category_id_1')
				<div class="form-error">{{ $message }}</div>
			@enderror
		</div>
		<div class="form-row">
			<select wire:model="category_id_2" required="required">
				<option value="">Categoría Opción 2</option>
				@foreach($topCategories as $id => $name)
					<option value="{{ $id }}">{{ $name }}</option>
				@endforeach
			</select>
			@error('category_id_2')
				<div class="form-error">{{ $message }}</div>
			@enderror
		</div>
		<div class="form-row">
			<input type="tel" wire:model="bookCategorySearch" wire:keyup="search" x-on:blur="$wire.showBookCategoriesList = false; $wire.$refresh()" required="required" placeholder="Categoría Opción 3" aria-label="Categoría Opción 3" />
			@if($showBookCategoriesList)
				<div class="autocomplete-box">
					<ul>
						@if(!empty($bookCategories))
							@foreach($bookCategories as $bookCategory)
								<li wire:click="getBookCategory({{ $bookCategory->id }})">{{ $bookCategory->name }}</li>
							@endforeach
						@endif
					</ul>
				</div>
			@endif
			@error('category_id_3')
				<div class="form-error">{{ $message }}</div>
			@enderror
		</div>
	</fieldset>

	{{-- Acceptance --}}
	<div class="form-row">
		<div class="checkbox-wrapper">
			<input type="checkbox" wire:model="accept" id="accept-1" required="required" />
			<div>
				<label for="accept-1">He leído y autorizo el tratamiento de mis datos según la <a href="{{ $privacyPolicyUrl }}">Política de Privacidad de Persé Librerías</a></label>
				@error('accept')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="checkbox-wrapper">
			<input type="checkbox" wire:model="accept_ads" id="accept-2" required="required" />
			<div>
				<label for="accept-2">Autorizo el tratamiento de mis datos con fines publicitarios según la <a href="{{ $privacyPolicyUrl }}">Política de Privacidad de Persé Librerías</a></label>
				@error('accept_ads')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	{{-- Submit --}}
	<div class="form-row">
		<button>Enviar</button>
	</div>
</form>
