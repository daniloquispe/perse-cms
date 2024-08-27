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
				<div class="stars">
					<div>
						@foreach([1, 2, 3, 4, 5] as $rate)
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
							</svg>
						@endforeach
					</div>
					<div>0 comentarios</div>
				</div>
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
				{{-- Comments --}}
				<div class="comments-box">
					<h2 class="section-title">Comentarios</h2>
					<div class="comments"></div>
					<input type="checkbox" id="show-comment-form" />
					<label for="show-comment-form" class="show-form-button">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
						</svg>
						Escribir un comentario
					</label>
					<div class="comment-form-wrapper">
						<livewire:comment-form />
					</div>
				</div>
			</footer>
		</div>
	</article>
@endsection
