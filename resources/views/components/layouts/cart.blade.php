<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>{{ $title }}</title>
	<link href="{{ asset('favicon.png') }}" rel="icon" />
	@vite('resources/css/app.css')
</head>
<body>
{{-- Header --}}
<header class="bg-palette-purple h-24 flex items-center fixed w-full">
	<img src="{{ asset('images/footer-logo.png') }}" alt="Persé Librerías" class="mx-auto" />
</header>
{{-- Main --}}
<main class="bg-palette-pink pt-24">{{ $slot }}</main>
{{-- Footer --}}
<footer>
	<div></div>
	<div class="border-t border-gray-200 py-6">
		<img src="{{ asset('images/payment-methods.png') }}" alt="Métodos de pago aceptados" class="mx-auto" />
	</div>
</footer>
<x-whatsapp-link />
<livewire:toast />
@vite('resources/js/app.js')
</body>
</html>
