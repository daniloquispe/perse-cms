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
		<div class="autocomplete-box">
			<div>
				<div>Libros para "{{ $searchString }}"</div>
				<ul class="autocomplete-items">
					@if(!empty($autocompleteList))
						@foreach($autocompleteList as $book)
							<li>
								<a href="{{ route('slug', $book->seoTags->slug) }}">
									<div>
										<img src="{{ (new \App\Services\UrlService())->fromAsset($book->cover_or_placeholder) }}" alt="{{ $book->title }}" />
										<div>
											<p class="title">{{ $book->title }}</p>
											<div class="prices">
												@if($book->discounted_price)
													S/&nbsp;{{ $book->discounted_price }}
													<del>S/&nbsp;{{ $book->price }}</del>
												@else
													S/&nbsp;{{ $book->price }}
												@endif
											</div>
										</div>
									</div>
								</a>
							</li>
						@endforeach
					@endif
				</ul>
				<div>
					<a href="{{ route('search', $searchString) }}">Ver todos los {{ $autocompleteCount }} libros</a>
				</div>
			</div>
		</div>
	@endif
</div>
