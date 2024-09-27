<div class="book-carousel" id="book-carousel-{{ $carousel->id }}">
    <h2 class="title">{{ $carousel->title }}</h2>
	<div class="splide" aria-label="{{ $carousel->title }}">
		<div class="splide__track">
			<div class="splide__list">
				@foreach($carousel->books as $book)
					<livewire:book-list-item wire:key="book-carousel-item-{{ $carousel->id }}-{{ $book->id }}" :book="$book" />
				@endforeach
			</div>
		</div>
	</div>
</div>
