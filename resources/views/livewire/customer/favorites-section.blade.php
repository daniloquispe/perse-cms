<div class="card">
	<div class="card-header">
		<p class="card-title">Favoritos</p>
	</div>
	<div class="card-body">
		<div class="books-list-container">
			@foreach($favorites as $favorite)
				<livewire:book-list-item wire:key="{{ $favorite->id }}" :book="$favorite" :as-favorite="true" />
			@endforeach
		</div>
	</div>
</div>
