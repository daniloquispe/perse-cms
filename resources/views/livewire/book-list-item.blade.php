<article @class(['book-list-item', 'splide__slide' => $inCarousel, 'hidden' => $asRemoved])>
	{{-- Cover and flags --}}
	<div class="book-cover">
		{{-- Presale? --}}
		@if($book->is_presale)
			<div class="presale">Preventa</div>
		@endif
		{{-- In favorites list --}}
		@if($asFavorite)
			<button type="button" wire:click="removeFromFavorites" class="remove-favorite-button">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
				</svg>
			</button>
		@endif
		{{-- Image --}}
		<a href="{{ $url }}"><img src="{{ asset($cover) }}" alt="{{ $book->title }}" /></a>
	</div>
	{{-- Book info --}}
	<div class="book-info">
		<a href="{{ $url }}">
			<h1 class="title">{{ $book->title }}</h1>
			<div class="author">{{ $authors }}</div>
			<div class="prices">
				@if($discount)
					<div class="current">S/&nbsp;{{ $book->discounted_price }}</div>
					<div class="normal"><del>S/{{ $book->price }}</del></div>
					<div class="discount">-{{ $discount }}%</div>
				@else
					<div class="current">S/&nbsp;{{ $book->price }}</div>
				@endif
			</div>
		</a>
	</div>
	{{-- Add to cart --}}
	<div class="book-controls">
		<button>Agregar</button>
	</div>
</article>
