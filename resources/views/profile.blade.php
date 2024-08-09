@extends('layouts.main')

@section('title', 'Mi perfil')

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<div class="container-box">
		<div class="grid grid-cols-5 gap-4">
			{{-- Sidebar --}}
			<div class="card">
				{{-- Avatar --}}
				<div class="avatar">
					{{-- https://www.promart.pe/_secure/account#/profile/edit --}}
					<svg viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="110" height="110" fill="black" fill-opacity="0"></rect><rect width="110" height="110" fill="black" fill-opacity="0"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M55 110C85.3757 110 110 85.3757 110 55C110 24.6243 85.3757 0 55 0C24.6243 0 0 24.6243 0 55C0 85.3757 24.6243 110 55 110Z" fill="#D8D8D8"></path><mask id="mask0" maskUnits="userSpaceOnUse" x="0" y="0" width="110" height="110"><path fill-rule="evenodd" clip-rule="evenodd" d="M55 110C85.3757 110 110 85.3757 110 55C110 24.6243 85.3757 0 55 0C24.6243 0 0 24.6243 0 55C0 85.3757 24.6243 110 55 110Z" fill="white"></path></mask><g mask="url(#mask0)"><rect width="85.3731" height="96.8655" fill="black" fill-opacity="0" transform="translate(13.1367 21.3433)"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M66.4949 78.5818H45.1516C27.4705 78.5818 13.1367 93.0978 13.1367 111.004C13.1367 111.004 29.1442 118.209 55.8233 118.209C82.5024 118.209 98.5098 111.004 98.5098 111.004C98.5098 93.0978 84.1761 78.5818 66.4949 78.5818Z" fill="#979797"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M30.7969 46C30.7969 32.3824 42.0001 21.3433 55.82 21.3433C69.64 21.3433 80.8432 32.3824 80.8432 46C80.8432 59.6175 69.64 74.1791 55.82 74.1791C42.0001 74.1791 30.7969 59.6175 30.7969 46Z" fill="#979797"></path></g></svg>
					<p>Bienvenido</p>
					@if(auth()->user()->name)
						<p class="text-xl">{{ auth()->user()->name }}</p>
					@endif
					<br />
				</div>
				{{-- Menu --}}
				<ul class="menu">
					<li class="active">
						<a href="{{ route('profile') }}">
							Perfil
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
							</svg>
						</a>
					</li>
					<li>
						<a href="{{ route('profile') }}">
							Direcciones
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
							</svg>
						</a>
					</li>
					<li>
						<a href="{{ route('profile') }}">
							Pedidos
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
							</svg>
						</a>
					</li>
					<li>
						<a href="{{ route('profile') }}">
							Mis favoritos
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
							</svg>
						</a>
					</li>
					<li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
				</ul>
			</div>
			{{-- Center --}}
			<div class="card col-span-4">
				<div class="card-header">
					<p class="card-title">Perfil</p>
				</div>
				<div class="card-body">
					<livewire:profile-form />
				</div>
			</div>
		</div>
	</div>
@endsection
