<article class="book-list-item">
	<header>
		@if($isPresale)
			<div class="presale">Preventa</div>
		@endif
		<div class="cover">
			<a href="{{ $url }}"><img src="{{ asset($cover) }}" alt="{{ $title }}" /></a>
		</div>
		<div class="title">{{ $title }}</div>
		<div class="author">{{ $authors }}</div>
	</header>
	<main class="prices">
		@if($discountedPrice)
			<div class="current">S/{{ $discountedPrice }}</div>
			<div class="normal"><del>S/{{ $price }}</del></div>
			<div class="discount">-{{ $discount }}%</div>
		@else
			<div class="current">S/{{ $price }}</div>
		@endif
	</main>
	<footer>
		<button>Agregar</button>
	</footer>
</article>
