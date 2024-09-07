<x-customer-card title="Favoritos">
	<div class="books-list-container">
		@foreach($favorites as $favorite)
			<x-book-list-item :book="$favorite" :as-favorite="true" />
		@endforeach
	</div>
</x-customer-card>
