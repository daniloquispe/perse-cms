@extends('layouts.main')

@section('title', 'Persé Librerías')

@section('content')
	<livewire:slider />
	{{-- Banners --}}
	<div class="container-box my-12">
		<div class="grid grid-cols-3 gap-10">
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
		</div>
	</div>
@endsection
