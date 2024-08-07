@extends('layouts.main')

@section('title', 'Persé Librerías')

@section('content')
	{{-- Main slider --}}
	<livewire:slider />
	{{-- Banners pequeños --}}
	<div class="container-box my-12">
		<div class="grid grid-rows-3 lg:grid-rows-1 lg:grid-cols-3 gap-10">
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
		</div>
	</div>
@endsection
