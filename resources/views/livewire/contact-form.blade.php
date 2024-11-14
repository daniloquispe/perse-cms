<form wire:submit="submit" class="contact-form">
	{{-- Name --}}
	<div class="form-row">
		<input type="text" wire:model="form.name" placeholder="Tu nombre *" required="required" aria-label="Tu nombre" />
		@error('form.name')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- E-mail --}}
	<div class="form-row">
		<input type="email" wire:model="form.email" placeholder="Correo electrónico *" required="required" aria-label="Correo electrónico" />
		@error('form.email')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- Phone --}}
	<div class="form-row">
		<input type="tel" wire:model="form.phone" placeholder="Teléfono" required="required" aria-label="Teléfono" />
		@error('form.phone')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- Message --}}
	<div class="form-row">
		<textarea rows="5" wire:model="form.message" placeholder="Mensaje *" required="required" aria-label="Mensaje"></textarea>
		@error('form.message')
			<div class="form-error">{{ $message }}</div>
		@enderror
	</div>
	{{-- Acceptance --}}
	<div class="form-row">
		<div class="checkbox-wrapper">
			<input type="checkbox" wire:model="form.acceptData" id="accept-1" required="required" />
			<div>
				<label for="accept-1">He leído y autorizo el tratamiento de mis datos según la <a href="{{ $privacyPolicyUrl }}">Política de Privacidad de {{ config('app.name') }}</a></label>
			</div>
			@error('form.acceptData')
				<div class="form-error">{{ $message }}</div>
			@enderror
		</div>
		<div class="checkbox-wrapper">
			<input type="checkbox" wire:model="form.acceptAds" id="accept-2" required="required" />
			<div>
				<label for="accept-2">Autorizo el tratamiento de mis datos con fines publicitarios según la <a href="{{ $privacyPolicyUrl }}">Política de Privacidad de {{ config('app.name') }}</a></label>
				@error('form.acceptAds')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	{{-- Submit --}}
	<div class="buttonbar">
		<button type="submit">Enviar</button>
	</div>
</form>
