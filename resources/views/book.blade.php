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
					<div><a href="#comments">Escribe tu comentario</a></div>
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
				<a id="comments"></a>
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
					<div class="comments">
						@foreach($book->comments as $comment)
							<div wire:key="comment-{{ $comment->id }}" class="comment">
								<div class="flex-none w-60 text-left">
									<p class="comment-name">{{ $comment->name }}</p>
									<p class="comment-date">{{ $comment->created_at->toDateString() }}</p>
								</div>
								<div class="grow">
									<div class="comment-rate">
										<x-stars-rate :value="$comment->rate" />
									</div>
									<div class="comment-text">{!! nl2br($comment->comment) !!}</div>
								</div>
								<div class="w-10">
									{{-- Reply --}}
									<button type="button" title="Responder">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
										</svg>
										<span class="sr-only">Responder</span>
									</button>
									{{-- Edit --}}
									<button type="button" title="Editar">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
										</svg>
										<span class="sr-only">Editar</span>
									</button>
									{{-- Delete --}}
									<button type="button" title="Eliminar" class="delete-button">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
										</svg>
										<span class="sr-only">Eliminar</span>
									</button>
								</div>
							</div>
						@endforeach
					</div>
					<livewire:comment-form :book-id="$book->id" />
				</div>
			</footer>
		</div>
	</article>
@endsection
