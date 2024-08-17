<article class="book-list-item">
	{{-- Cover and flags --}}
	<div class="book-cover">
		{{-- Presale? --}}
		@if($book->is_presale)
			<div class="presale">Preventa</div>
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
