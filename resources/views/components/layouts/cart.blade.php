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
	<img src="{{ asset('images/logo-perse-carrito.png') }}" alt="Persé Librerías" class="mx-auto" />
</header>
{{-- Main --}}
<main class="bg-palette-pink pt-24">{{ $slot }}</main>
{{-- Footer --}}
<footer>
	<div class="flex flex-col sm:flex-row w-fit sm:w-full sm:justify-between gap-y-4 mx-auto sm:max-w-[44rem] px-4 xl:px-0 py-6">
		<div>
			{{-- Call us --}}
			<div class="flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
				</svg>
				Llámenos
			</div>
			<div class="text-gray-400">+51 994 574 823</div>
		</div>
		<div>
			{{-- Write us --}}
			<div class="flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
				</svg>
				Escríbanos
			</div>
			<div class="text-gray-400">+51 994 574 823</div>
		</div>
		<div>
			{{-- Contact us --}}
			<div class="flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
				</svg>
				Contáctenos
			</div>
			<div class="text-gray-400">ventas@perselibrerias.com.pe</div>
		</div>
	</div>
	<div class="border-t border-gray-200 px-4 py-6">
		<img src="{{ asset('images/payment-methods.png') }}" alt="Métodos de pago aceptados" class="mx-auto" />
	</div>
</footer>
<x-whatsapp-link />
<livewire:toast />
@vite('resources/js/app.js')
</body>
</html>
