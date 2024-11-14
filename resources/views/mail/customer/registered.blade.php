@extends('mail.mail-layout')

@section('title', sprintf("¡Te has registrado en %s! 💜🧡", config('app.name')))

@section('styles')
    <style>
		/*.access-code
		{
			display: flex;
			align-items: center;
			gap: 1rem;
			padding-left: calc(3.5rem + 2rem + 1rem + 1px + 1rem);
			font-size: 4rem;
			{{-- @apply text-palette-purple; --}}
			color: #AD60BF;
			font-weight: bold;

			img
			{
				width: 60%;
				height: auto;
			}
		}*/

		.notes
		{
			padding: 0 3.5rem 2rem calc(3.5rem + 2rem + 1rem + 1px + 1rem);

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
	<h1 class="main-title">¡Te damos la Bienvenida!</h1>
    <section class="auth">
		<div>
			<x-icons.key />
		</div>
		<div>
			<p class="hello">Hola, {{ $customer->email }}</p>
			<p>🤗 Te has registrado con éxito a {{ config('app.name') }} y ya puedes realizar tu primer pedido.</p>
		</div>
	</section>
	<div class="notes">
		<p>No te preocupes: este procedimiento es 100% seguro.</p>
		<p>y lo realizamos para proteger tu información.</p>
	</div>
@endsection
