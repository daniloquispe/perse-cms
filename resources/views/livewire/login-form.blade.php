<div>
	<form wire:submit="login" id="register-form" method="post">
		<input wire:model="email" type="email" id="input-email" required="required" placeholder="Su e-mail" aria-label="Su E-mail" />
		@error('email')
			<div class="form-error">{{ $message }}</div>
		@enderror
		<input wire:model="password" type="password" id="input-password" required="required" placeholder="Su contraseña" aria-label="Su Contraseña" />
		@error('password')
			<div class="form-error">{{ $message }}</div>
		@enderror
		<p><a href="/recuperar-contrasena">Olvidé mi contraseña</a></p>
		<button>Entrar</button>
		@if($success)
			<div wire:transition>¡Inicio de sesión exitoso!</div>
		@endif
		@if($error)
			<div wire:transition>Error en el inicio de sesión</div>
		@endif
	</form>
</div>
