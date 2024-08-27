<div>
	@if($step == 1)
		<div class="grid grid-cols-2 gap-4">
			<div>
				<h2>Escoja una opción para entrar</h2>
				<div class="access-wrapper">
					<button class="access-button access-email">Recibir código de acceso por e-mail</button>
					<button class="access-button access-google">Ingresa con Google</button>
					<button class="access-button access-facebook">Ingresa con Facebook</button>
				</div>
			</div>
			<div>
				<h2>Recibir código de acceso por e-mail</h2>
				{{-- Form --}}
				<form wire:submit="submit" id="register-form" method="post">
					<input type="email" wire:model="accessCodeForm.email" id="input-email" required="required" placeholder="Ej. ejemplo@mail.com" aria-label="E-mail" />
					@error('email')
						<div class="form-error">{{ $message }}</div>
					@enderror
					<button type="submit">Enviar código</button>
					<p>¿Ya tiene una cuenta? <a href="{{ $loginUrl }}">Inicie sesión</a></p>
				</form>
			</div>
		</div>
	@else
		<h2 class="sr-only">Validar correo electrónico y crear una nueva contraseña</h2>
		<p>Ingrese el código que enviamos a {{ $email }} y cree una nueva contraseña</p>
		{{-- Form --}}
		<form wire:submit="submit" id="register-form" method="post">
			<input type="text" wire:model="registrationForm.access_code" required="required" placeholder="Ingrese su código de acceso" aria-label="Código de acceso" />
			@error('access_code')
				<div class="form-error">{{ $message }}</div>
			@enderror
			<input type="password" wire:model="registrationForm.password" id="input-password" required="required" placeholder="Ingrese su contraseña" aria-label="Contraseña" />
			@error('password')
				<div class="form-error">{{ $message }}</div>
			@enderror
			<input type="password" wire:model="registrationForm.password_confirmation" id="input-password_confirmation" required="required" placeholder="Confirmar contraseña" aria-label="Confirmar Contraseña" />
			@error('password_confirmation')
				<div class="form-error">{{ $message }}</div>
			@enderror
			<div class="checkbox-wrapper">
				<input type="checkbox" wire:model="registrationForm.accept" id="input-accept" required="required" />
				<div class="opacity-70">
					<label for="input-accept">He leído y autorizo el tratamiento de mis datos según la <a href="{{ $privacyPolicyUrl }}">Política de Privacidad</a> y <a href="{{ $termsUrl }}">Términos y Condiciones</a></label>
				</div>
			</div>
			<div class="grid grid-cols-2 gap-10 mb-3">
				<button type="button" wire:click="goBack" class="text-right">&larr; Volver</button>
				<button type="submit">Entrar</button>
			</div>
			<p>¿Ya tiene una cuenta? <a href="{{ $loginUrl }}">Inicie sesión</a></p>
		</form>
	@endif
</div>
