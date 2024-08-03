<div>
	<form wire:submit="createUser" id="register-form" method="post">
		@csrf
		<input wire:model="email" type="email" id="input-email" required="required" placeholder="Su e-mail" aria-label="Su E-mail" />
		<input wire:model="password" type="password" id="input-password" required="required" placeholder="Su contraseña" aria-label="Su Contraseña" />
		<p><a href="/recuperar-contrasena">Olvidé mi contraseña</a></p>
		<button>Entrar</button>
		@if($success)
			<div wire:transition>¡Registro exitoso!</div>
		@endif
		@if($error)
			<div wire:transition>Error en el registro</div>
		@endif
	</form>
</div>
