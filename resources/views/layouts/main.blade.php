<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>@yield('title')</title>
	<link href="{{ asset('favicon.png') }}" rel="icon" />
	@vite('resources/css/app.css')
</head>
<body>
<livewire:site-header />
<main class="main-content">@yield('content')</main>
<livewire:site-footer />
<x-whatsapp-link />
<livewire:toast />
@vite('resources/js/app.js')
@yield('js-footer')
</body>
</html>
