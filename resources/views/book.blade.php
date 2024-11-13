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
			<div class="cover-wrapper">
				<img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" />
			</div>
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
					{{-- Price --}}
					<div class="price">S/&nbsp;{{ $book->price }}</div>
					{{-- Add to cart --}}
					<livewire:add-to-cart-form :book="$book" />
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
								<div class="w-full xl:w-10 text-right">
									{{-- Reply --}}
									<button type="button" title="Responder" class="action-button">
										<x-icons.back />
										<span class="sr-only">Responder</span>
									</button>
									{{-- Edit --}}
									<button type="button" title="Editar" class="action-button">
										<x-icons.pencil-square />
										<span class="sr-only">Editar</span>
									</button>
									{{-- Delete --}}
									<button type="button" title="Eliminar" class="action-button destructive-action">
										<x-icons.trash />
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
