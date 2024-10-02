<div class="search-form">
	<form wire:submit="search">
		{{-- Search --}}
		<input type="search" wire:model="searchString" wire:keyup="autocomplete" wire:focus="onFocusEvent" wire:blur="onBlurEvent" placeholder="Busca por título, autor, género o ISBN" aria-label="Buscar" />
		{{-- Reset button --}}
		@if($this->showResetButton)
			<button type="reset" title="Borrar">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
				</svg>
				<span>Borrar</span>
			</button>
		@endif
		{{-- Search button --}}
		<button type="submit" title="Buscar">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
			</svg>
			<span>Buscar</span>
		</button>
	</form>
	@if($showAutocompleteList)
		<div class="autocomplete-box w-full">
			<ul class="max-h-64 overflow-scroll">
				@if(!empty($autocompleteList))
					@foreach($autocompleteList as $autocompleteListItem)
						<li>
							<a href="{{ route('slug', $autocompleteListItem->seoTags->slug) }}">{{ $autocompleteListItem->title }}</a>
						</li>
					@endforeach
				@endif
			</ul>
		</div>
	@endif
</div>
