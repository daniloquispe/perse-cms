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
					<div>
						<p>Editorial</p>
						<ul>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
						</ul>
						<button type="button" class="more-filters-button">Ver más 197</button>
					</div>
					<div>
						<p>Autor</p>
						<ul>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
						</ul>
						<button type="button" class="more-filters-button">Ver más 197</button>
					</div>
					<div>
						<p>Edad</p>
						<ul>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
						</ul>
						<button type="button" class="more-filters-button">Ver más 197</button>
					</div>
					<div>
						<p>Formato</p>
						<ul>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
							<li>
								<input type="checkbox" />
								<label>Filter</label>
							</li>
						</ul>
						<button type="button" class="more-filters-button">Ver más 197</button>
					</div>
				</div>
			</div>
		</div>
		<div class="center">
			<h2>{{ $title }}</h2>
			<div class="description-wrapper">
				<div>Se ha encontrado {{ $count }} {{ $searchResultsLabel }}</div>
				<div>
					<label>Ordenar por:</label>
					<select wire:model="order">
						<option value="{{ \App\BookSearchResultsOrder::ByRelevance->value }}">Relevancia</option>
						<option value="{{ \App\BookSearchResultsOrder::Latest->value }}">Más reciente</option>
						<option value="{{ \App\BookSearchResultsOrder::ByPriceAscending->value }}">Precios más alto</option>
						<option value="{{ \App\BookSearchResultsOrder::ByPriceDescending->value }}">Precios más bajo</option>
						<option value="{{ \App\BookSearchResultsOrder::ByTitleAscending->value }}">Nombre, creciente</option>
						<option value="{{ \App\BookSearchResultsOrder::ByTitleDescending->value }}">Nombre, decreciente</option>
					</select>
				</div>
			</div>
			<div class="books">
				@foreach($books as $book)
					<livewire:book-list-item wire:key="{{ $book->id }}" :cover="asset('storage/' . $book->cover)" :title="$book->title" :authors="$book->authors" :price="$book->price" :discounted-price="$book->discounted_price" :url="$book->seoTags->slug" :is-presale="$book->is_presale" />
				@endforeach
			</div>
			@if($count > count($books))
				<button type="button" class="more-button">Mostrar más</button>
			@endif
		</div>
	</div>
</div>
