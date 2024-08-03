@extends('layouts.main')

@section('title', $page->seoTags->meta_title)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<div class="container-box-auth">
		<h2>Escoja una opción para entrar</h2>
		<button class="access-button access-email">Recibir código de acceso por e-mail</button>
		<p>Ó</p>
		<div class="access-wrapper">
			<button class="access-button access-google">Ingresa con Google</button>
			<button class="access-button access-facebook">Ingresa con Facebook</button>
		</div>
		<p>Entrar con e-mail y contraseña</p>
		<livewire:login-form />
		<p>¿No tiene una cuenta? <a href="/crear-cuenta">Regístrese</a></p>
	</div>
@endsection
