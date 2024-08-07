<div>
	<div class="container-box content-wrapper book-category">
		<div class="filters-col">
			<div class="filters-box">
				<div class="title">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
					</svg>
					Filtrar por:
				</div>
				<div class="content">
					{{-- Filter: Publisher --}}
					@if(count($publisherFilters) > 0)
						<div>
							<p>Editorial</p>
							<ul>
								@foreach($publisherFilters as $id => $filter)
									<li wire:key="publisher-{{ $id }}">
										<input wire:model="$filter['checked']" type="checkbox" id="filter-publisher-{{ $id }}" />
										<label for="filter-publisher-{{ $id }}">{{ $filter['name'] }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($publisherFilters) > 7)
								<button type="button" class="more-filters-button">Ver más 197</button>
							@endif
						</div>
					@endif
					@if(count($authorFilters) > 0)
						<div>
							<p>Autor</p>
							<ul>
								@foreach($authorFilters as $id => $filter)
									<li wire:key="author-{{ $id }}">
										<input wire:model="$filter['checked']" type="checkbox" id="filter-author-{{ $id }}" />
										<label for="filter-author-{{ $id }}">{{ $filter['name'] }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($authorFilters) > 7)
								<button type="button" class="more-filters-button">Ver más 197</button>
							@endif
						</div>
					@endif
					@if(count($ageRangeFilters) > 0)
						<div>
							<p>Edad</p>
							<ul>
								@foreach($ageRangeFilters as $id => $filter)
									<li wire:key="age-range-{{ $id }}">
										<input wire:model="$filter['checked']" type="checkbox" id="filter-age-range-{{ $id }}" />
										<label for="filter-age-range-{{ $id }}">{{ $filter['name'] }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($ageRangeFilters) > 7)
								<button type="button" class="more-filters-button">Ver más 197</button>
							@endif
						</div>
					@endif
					@if(count($formatFilters) > 0)
						<div>
							<p>Formato</p>
							<ul>
								@foreach($formatFilters as $id => $filter)
									<li wire:key="format-{{ $id }}">
										<input wire:model="$filter['checked']" type="checkbox" id="filter-format-{{ $id }}" />
										<label for="filter-format-{{ $id }}">{{ $filter['name'] }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($formatFilters) > 7)
								<button type="button" class="more-filters-button">Ver más 197</button>
							@endif
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="center">
			<h2>{{ $title }}</h2>
			<div class="description-wrapper">
				<div>Se ha encontrado {{ $count }} {{ $searchResultsLabel }}</div>
				<div>
					@if(false)
					<label>Ordenar por:</label>
					<select wire:model="order" wire:change="loadBooks">
						<option value="{{ \App\BookSearchResultsOrder::ByRelevance->value }}">Relevancia</option>
						<option value="{{ \App\BookSearchResultsOrder::Latest->value }}">Más reciente</option>
						<option value="{{ \App\BookSearchResultsOrder::ByPriceAscending->value }}">Precios más alto</option>
						<option value="{{ \App\BookSearchResultsOrder::ByPriceDescending->value }}">Precios más bajo</option>
						<option value="{{ \App\BookSearchResultsOrder::ByTitleAscending->value }}">Nombre, creciente</option>
						<option value="{{ \App\BookSearchResultsOrder::ByTitleDescending->value }}">Nombre, decreciente</option>
					</select>
					@endif
					<button type="button" class="order-menu-button">Ordenar por: <span>{{ $order->getLabel() }}</span></button>
					<input type="hidden" wire:model.change="order" wire:change="loadBooks" id="order" />
					<ul class="order-options closed">
						<li data-value="{{ \App\BookSearchResultsOrder::ByRelevance->value }}">Relevancia</li>
						<li data-value="{{ \App\BookSearchResultsOrder::Latest->value }}">Más reciente</li>
						<li data-value="{{ \App\BookSearchResultsOrder::ByPriceAscending->value }}">Precios más alto</li>
						<li data-value="{{ \App\BookSearchResultsOrder::ByPriceDescending->value }}">Precios más bajo</li>
						<li data-value="{{ \App\BookSearchResultsOrder::ByTitleAscending->value }}">Nombre, creciente</li>
						<li data-value="{{ \App\BookSearchResultsOrder::ByTitleDescending->value }}">Nombre, decreciente</li>
					</ul>
				</div>
			</div>
			<div class="books">
				@foreach($books as $book)
					<livewire:book-list-item wire:key="{{ $book->id }}" :cover="asset('storage/' . $book->cover)" :title="$book->title" :authors="$book->authors" :price="$book->price" :discounted-price="$book->discounted_price" :url="$book->seoTags->slug" :is-presale="$book->is_presale" />
				@endforeach
			</div>
			@if($count > count($books))
				<button wire:click="loadMoreBooks" type="button" class="more-button">Mostrar más</button>
			@endif
		</div>
	</div>
</div>

@script
<script>
	const button = document.querySelector('.order-menu-button');
	button.addEventListener('click', function ()
	{
		document.querySelector('.order-options').classList.toggle('closed');
	});

	document.querySelector('.order-options').addEventListener('click', function (e)
	{
		if (e.target && e.target.nodeName === 'LI')
		{
			$wire.order = e.target.getAttribute('data-value');
			$wire.loadBooks();
		}
	});
</script>
@endscript
