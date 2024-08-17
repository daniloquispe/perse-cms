@extends('layouts.main')

@section('title', $book->seoTags->meta_title)
@section('description', $book->seoTags->meta_description)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<article class="container-box content-wrapper book">
		<div class="left">
			{{-- Cover --}}
			<img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" />
			{{-- Info box --}}
			<dl>
				<dt>Formato</dt>
				<dd>{{ $book->bookFormat->name }}</dd>
				<dt>SKU</dt>
				<dd>{{ $book->sku }}</dd>
				<dt>ISBN</dt>
				<dd>{{ $book->isbn }}</dd>
				@foreach($book->authors as $author)
					<dt>Autor</dt>
					<dd>{{ $author->name }}</dd>
				@endforeach
				<dt>Editorial</dt>
				<dd>{{ $book->publisher?->name }}</dd>
				<dt>Año</dt>
				<dd>{{ $book->year }}</dd>
				<dt>Páginas</dt>
				<dd>{{ $book->pages_count }}</dd>
				<dt>Encuadernación</dt>
				<dd>{{ $book->bookbindingType->name }}</dd>
				<dt>Idioma</dt>
				<dd>Español</dd>
				<dt>Peso</dt>
				<dd>{{ $book->weight }} kg</dd>
				<dt>Ancho</dt>
				<dd>{{ $book->width }}</dd>
				<dt>Altura</dt>
				<dd>{{ $book->height }}</dd>
				<dt>Edad</dt>
				<dd>{{ $book->ageRange->name }}</dd>
			</dl>
		</div>
		<div class="center">
			<header>
				<h1 class="title">{{ $book->title }}</h1>
				<div class="author">
					@foreach($book->authors as $author)
						<a href="#">{{ $author->name }}</a>{{ $loop->last ? '' : ', ' }}
					@endforeach
					{{ $book->authors->count() != 1 ? '(Autores)' : '(Autor)' }}
				</div>
				<div>Rating</div>
				<div class="cart-box">
					<div class="price">S/ {{ $book->price }}</div>
					<form>
						<x-form.quantity-input name="quantity" />
						<button type="submit">Agregar al carrito</button>
					</form>
				</div>
			</header>
			<main>
				<h2 class="section-title">Sinopsis</h2>
				<div class="document">{!! $book->summary !!}</div>
			</main>
			<footer>
				{{-- Authors --}}
				<div class="authors-box">
					@foreach($book->authors as $author)
						<div class="author-box">
							<div class="photo">
								<img src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}" />
							</div>
							<div class="info">
								<p class="name">{{ $author->name }}</p>
								<p class="summary">{{ $author->summary }}</p>
								<p><a href="/category">Ver otros libros del mismo Autor</a></p>
							</div>
						</div>
					@endforeach
				</div>
				{{-- Add to favorites --}}
				<livewire:add-to-favorites-button :book-id="$book->id" />
			</footer>
		</div>
	</article>
@endsection
