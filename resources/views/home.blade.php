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
		<img src="{{ asset('images/placeholders/banners/desktop/cuentos-infantiles-de-3-a-5-anos-perse-librerias.jpg') }}" alt="Banner" class="hidden md:block w-full rounded-lg" />
		<img src="{{ asset('images/placeholders/banners/mobile/cuentos-infantiles-de-3-a-5-anos-perse-librerias.jpg') }}" alt="Banner" class="block md:hidden w-full rounded-lg" />
	</section>
	{{-- Book carousels (below) --}}
	@foreach($carouselsBelow as $carousel)
		<section class="container-box mb-9">
			<livewire:book-carousel :wire:key="$carousel->id" :carousel="$carousel" />
		</section>
	@endforeach
	{{-- Small banners --}}
	<section class="container-box mb-11 pt-1.5">
		<div class="grid grid-rows-3 lg:grid-rows-1 lg:grid-cols-3 gap-x-10 gap-y-6">
			<div><img src="{{ asset('images/placeholders/banners/libros-infantiles-de-accion-y-aventuras-perse-librerias.jpg') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banners/pack-la-serie-completa-harry-potter-perse-librerias.jpg') }}" alt="Banner" class="w-full rounded-lg" /></div>
			<div><img src="{{ asset('images/placeholders/banners/el-hobbit-ilustrado-perse-librerias.jpg') }}" alt="Banner" class="w-full rounded-lg" /></div>
		</div>
	</section>
@endsection
