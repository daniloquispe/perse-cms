@extends('mail.mail-layout')

@section('title', "Su clave de acceso es $accessCode")

@section('styles')
    <style>
		.access-code
		{
			display: flex;
			align-items: center;
			gap: 1rem;
			padding-left: calc(3.5rem + 2rem + 1rem + 1px + 1rem);
			font-size: 4rem;
			color: #9143bc;
			font-weight: bold;

			img
			{
				width: 60%;
				height: auto;
			}
		}

		.notes
		{
			padding: 2rem 3.5rem 2rem calc(3.5rem + 2rem + 1rem + 1px + 1rem);

			p
			{
				color: rgb(75 85 99);

				&:first-child
				{
					margin-bottom: 0.5rem;
				}
			}
		}
	</style>
@endsection

@section('content')
	<h1 class="main-title">Tu Clave de Acceso</h1>
    <section class="auth">
		<div>
			<x-icons.key />
		</div>
		<div>
			<p class="hello">Hola, {{ $firstName }}</p>
			<p>Para acceder a la página que deseas necesitamos que confirmes tu identidad.</p>
			<p>Ingresa el siguiente código en la página anterior:</p>
		</div>
	</section>
	<div>
		<div class="access-code">
			<div>{{ $accessCode }}</div>
			<div><img src="{{ asset('images/mail/candado.png') }}" alt="Código de acceso" /></div>
		</div>
	</div>
	<div class="notes">
		<p>No te preocupes: este procedimiento es 100% seguro.</p>
		<p>y lo realizamos para proteger tu información.</p>
	</div>
@endsection
