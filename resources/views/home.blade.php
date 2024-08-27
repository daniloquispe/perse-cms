@extends('layouts.main')

@section('title', 'Persé Librerías')

@section('content')
	{{-- Main slider --}}
	<livewire:slider />
	{{-- Book carousels (above) --}}
	@foreach($carouselsAbove as $carousel)
		<section class="container-box mb-9">
			<livewire:book-carousel :wire:key="$carousel->id" :carousel="$carousel" />
		</section>
	@endforeach
	{{-- Big banner --}}
	<section class="container-box mb-9 pt-1">
		<img src="{{ asset('images/placeholders/wide-banner.png') }}" alt="Banner" class="w-full rounded-lg" />
	</section>
	{{-- Book carousels (below) --}}
	@foreach($carouselsBelow as $carousel)
		<section class="container-box mb-9">
			<livewire:book-carousel :wire:key="$carousel->id" :carousel="$carousel" />
		</section>
	@endforeach
	{{-- Small banners --}}
	<section class="container-box mb-11 pt-2">
		<div class="grid grid-rows-3 lg:grid-rows-1 lg:grid-cols-3 gap-10">
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banner.png') }}" alt="Banner" class="w-full rounded-lg" /></div>
		</div>
	</section>
@endsection
