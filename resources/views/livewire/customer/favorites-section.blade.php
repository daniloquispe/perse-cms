<x-customer-card title="Favoritos">
	<div class="books-list-container">
		@foreach($favorites as $favorite)
			<livewire:book-list-item wire:key="favorites-item-{{ $favorite->id }}" :book="$favorite" :as-favorite="true" />
		@endforeach
	</div>
</x-customer-card>
