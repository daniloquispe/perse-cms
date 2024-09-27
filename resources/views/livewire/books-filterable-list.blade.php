<div>
	<div class="container-box content-wrapper book-category">
		<div class="filters-col">
			<div class="filters-box">
				<div class="title">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.7656 1C14.7656 0.447715 14.3179 0 13.7656 0C13.2133 0 12.7656 0.447715 12.7656 1V3.50879V6.38329C12.7656 6.93558 13.2133 7.38329 13.7656 7.38329C14.3179 7.38329 14.7656 6.93558 14.7656 6.38329V4.50879H18.9622C19.5145 4.50879 19.9622 4.06107 19.9622 3.50879C19.9622 2.9565 19.5145 2.50879 18.9622 2.50879H14.7656V1ZM1.07408 2.15039C0.48088 2.15039 0 2.59811 0 3.15039C0 3.70268 0.48088 4.15039 1.07408 4.15039H8.92592C9.51912 4.15039 10 3.70268 10 3.15039C10 2.59811 9.51912 2.15039 8.92592 2.15039H1.07408ZM6.4176 6.45801C6.96988 6.45801 7.4176 6.90572 7.4176 7.45801V12.496C7.4176 13.0483 6.96988 13.496 6.4176 13.496C5.86531 13.496 5.4176 13.0483 5.4176 12.496V10.8408H1.04688C0.49459 10.8408 0.046875 10.3931 0.046875 9.84082C0.046875 9.28854 0.49459 8.84082 1.04688 8.84082H5.4176V7.45801C5.4176 6.90572 5.86531 6.45801 6.4176 6.45801ZM1.35005 16.0166C0.630327 16.0166 0.046875 16.4643 0.046875 17.0166C0.046875 17.5689 0.630327 18.0166 1.35005 18.0166H6.11479C6.83452 18.0166 7.41797 17.5689 7.41797 17.0166C7.41797 16.4643 6.83452 16.0166 6.11479 16.0166H1.35005ZM9.09375 9.84082C9.09375 9.28854 9.62512 8.84082 10.2806 8.84082H18.7721C19.4276 8.84082 19.959 9.28854 19.959 9.84082C19.959 10.3931 19.4276 10.8408 18.7721 10.8408H10.2806C9.62512 10.8408 9.09375 10.3931 9.09375 9.84082ZM11.0742 15.042C11.0742 14.4897 10.6265 14.042 10.0742 14.042C9.52193 14.042 9.07422 14.4897 9.07422 15.042V18.901C9.07422 19.4533 9.52193 19.901 10.0742 19.901C10.6265 19.901 11.0742 19.4533 11.0742 18.901V18.0165H18.947C19.4993 18.0165 19.947 17.5688 19.947 17.0165C19.947 16.4642 19.4993 16.0165 18.947 16.0165H11.0742V15.042Z" fill="white"/>
					</svg>
					<div>Filtrar por</div>
				</div>
				<div class="content">
					{{-- Filter: Publisher --}}
					@if(count($publisherFilters) > 0)
						<div>
							<p>Editorial</p>
							<ul>
								@foreach($publisherFilters as $id => $name)
									<li wire:key="publisher-{{ $id }}">
										<input type="checkbox" wire:model="selectedPublisherFilters" wire:click="applyFilters" value="{{ $id }}" id="filter-publisher-{{ $id }}" />
										<label for="filter-publisher-{{ $id }}">{{ $name }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($publisherFilters) > 1)
								<button type="button" class="more-filters-button">Ver más
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
									</svg>
								</button>
							@endif
						</div>
					@endif
					{{-- Filter: Author --}}
					@if(count($authorFilters) > 0)
						<div>
							<p>Autor</p>
							<ul>
								@foreach($authorFilters as $id => $name)
									<li wire:key="author-{{ $id }}">
										<input type="checkbox" wire:model="selectedAuthorFilters" wire:click="applyFilters" value="{{ $id }}" id="filter-author-{{ $id }}" />
										<label for="filter-author-{{ $id }}">{{ $name }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($authorFilters) > 1)
								<button type="button" class="more-filters-button">Ver más
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
									</svg>
								</button>
							@endif
						</div>
					@endif
					{{-- Filter: Age range --}}
					@if(count($ageRangeFilters) > 0)
						<div>
							<p>Edad</p>
							<ul>
								@foreach($ageRangeFilters as $id => $name)
									<li wire:key="age-range-{{ $id }}">
										<input type="checkbox" wire:model="selectedAgeRangeFilters" wire:click="applyFilters" value="{{ $id }}" id="filter-age-range-{{ $id }}" />
										<label for="filter-age-range-{{ $id }}">{{ $name }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($ageRangeFilters) > 1)
								<button type="button" class="more-filters-button">Ver más
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
									</svg>
								</button>
							@endif
						</div>
					@endif
					{{-- Filter: Bookbinding type --}}
					@if(count($formatFilters) > 0)
						<div>
							<p>Encuadernación</p>
							<ul>
								@foreach($formatFilters as $id => $name)
									<li wire:key="bookbinding-type-{{ $id }}">
										<input type="checkbox" wire:model="selectedBookbindingTypeFilters" wire:click="applyFilters" value="{{ $id }}" id="filter-bookbinding-type-{{ $id }}" />
										<label for="filter-bookbinding-type-{{ $id }}">{{ $name }}</label>
									</li>
								@endforeach
							</ul>
							@if(count($formatFilters) > 7)
								<button type="button" class="more-filters-button">Ver más
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
									</svg>
								</button>
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
				<div class="description-buttons-wrapper">
					<div>
						{{-- Filters (mobile) --}}
						<div class="off-canvas-wrapper">
							<input type="checkbox" class="off-canvas-toggle" id="filters-sidebar-active" />
							<label for="filters-sidebar-active" class="button">
								Filtrar por
								<x-icons.chevron-down />
							</label>
							{{-- Overlay --}}
							<label for="filters-sidebar-active" class="off-canvas-overlay"></label>
							{{-- Sidebar --}}
							<div id="filters-sidebar" class="off-canvas-sidebar">
								{{-- Scrollpane --}}
								<div>
									{{-- Level cols --}}
									<form wire:submit="applyFilters" id="mobile-filters-form" class="level-cols" data-level="1">
										<div class="level-col level-col-1">
											<div data-id="0">
												{{-- Menu title --}}
												<p class="menu-title">Filtros</p>
												{{-- Menu items --}}
												<ul>
													@if(count($publisherFilters) > 0)
														<li class="menu-item">
															<button type="button" class="menu-link with-scroll" data-level="1" data-show="1">
																<div data-level="1" data-show="1">Editorial</div>
																<div data-level="1" data-show="1">
																	<x-icons.chevron-right data-level="1" data-show="1" />
																</div>
															</button>
														</li>
													@endif
													@if(count($authorFilters) > 0)
														<li class="menu-item">
															<button type="button" class="menu-link with-scroll" data-level="1" data-show="2">
																<div data-level="1" data-show="2">Autor</div>
																<div data-level="1" data-show="2">
																	<x-icons.chevron-right data-level="1" data-show="2" />
																</div>
															</button>
														</li>
													@endif
													@if(count($ageRangeFilters) > 0)
														<li class="menu-item">
															<button type="button" class="menu-link with-scroll" data-level="1" data-show="3">
																<div data-level="1" data-show="3">Edad</div>
																<div data-level="1" data-show="3">
																	<x-icons.chevron-right data-level="1" data-show="3" />
																</div>
															</button>
														</li>
													@endif
													@if(count($formatFilters) > 0)
														<li class="menu-item">
															<button type="button" class="menu-link with-scroll" data-level="1" data-show="4">
																<div data-level="1" data-show="4">Encuadernación</div>
																<div data-level="1" data-show="4">
																	<x-icons.chevron-right data-level="1" data-show="4" />
																</div>
															</button>
														</li>
													@endif
												</ul>
											</div>
										</div>
										<div class="level-col level-col-2">
											{{-- Filter: Publisher --}}
											@if(count($publisherFilters) > 0)
												<div class="can-show" data-id="1">
													{{-- Menu title --}}
													<p class="menu-title">
														<button type="button" class="back-button with-scroll" data-level="0">Filtros</button>
														<x-icons.chevron-right class="inline size-4 stroke-2" />
														Editorial
													</p>
													{{-- Menu items --}}
													<ul>
														@foreach($publisherFilters as $id => $name)
															<li class="menu-item">
																<div class="menu-checkbox">
																	<div class="checkbox-wrapper">
																		<input type="checkbox" wire:model="selectedPublisherFilters" value="{{ $id }}" id="mobile-filter-publisher-{{ $id }}" />
																		<label for="mobile-filter-publisher-{{ $id }}">{{ $name }}</label>
																	</div>
																</div>
															</li>
														@endforeach
													</ul>
												</div>
											@endif
											{{-- Filter: Author --}}
											@if(count($authorFilters) > 0)
												<div class="can-show" data-id="2">
													{{-- Menu title --}}
													<p class="menu-title">
														<button type="button" class="back-button with-scroll" data-level="0">Filtros</button>
														<x-icons.chevron-right class="inline size-4 stroke-2" />
														Autor
													</p>
													{{-- Menu items --}}
													<ul>
														@foreach($authorFilters as $id => $name)
															<li class="menu-item">
																<div class="menu-checkbox">
																	<div class="checkbox-wrapper">
																		<input type="checkbox" wire:model="selectedAuthorFilters" value="{{ $id }}" id="mobile-filter-author-{{ $id }}" />
																		<label for="mobile-filter-author-{{ $id }}">{{ $name }}</label>
																	</div>
																</div>
															</li>
														@endforeach
													</ul>
												</div>
											@endif
											{{-- Filter: Age range --}}
											@if(count($ageRangeFilters) > 0)
												<div class="can-show" data-id="3">
													{{-- Menu title --}}
													<p class="menu-title">
														<button type="button" class="back-button with-scroll" data-level="0">Filtros</button>
														<x-icons.chevron-right class="inline size-4 stroke-2" />
														Edad
													</p>
													{{-- Menu items --}}
													<ul>
														@foreach($ageRangeFilters as $id => $name)
															<li class="menu-item">
																<div class="menu-checkbox">
																	<div class="checkbox-wrapper">
																		<input type="checkbox" wire:model="selectedAgeRangeFilters" value="{{ $id }}" id="mobile-filter-age-range-{{ $id }}" />
																		<label for="mobile-filter-age-range-{{ $id }}">{{ $name }}</label>
																	</div>
																</div>
															</li>
														@endforeach
													</ul>
												</div>
											@endif
											{{-- Filter: Bookbinding type --}}
											@if(count($formatFilters) > 0)
												<div class="can-show" data-id="4">
													{{-- Menu title --}}
													<p class="menu-title">
														<button type="button" class="back-button with-scroll" data-level="0">Filtros</button>
														<x-icons.chevron-right class="inline size-4 stroke-2" />
														Encuadernación
													</p>
													{{-- Menu items --}}
													<ul>
														@foreach($formatFilters as $id => $name)
															<li class="menu-item">
																<div class="menu-checkbox">
																	<div class="checkbox-wrapper">
																		<input type="checkbox" wire:model="selectedBookbindingTypeFilters" value="{{ $id }}" id="mobile-filter-bookbinding-type-{{ $id }}" />
																		<label for="mobile-filter-bookbinding-type-{{ $id }}">{{ $name }}</label>
																	</div>
																</div>
															</li>
														@endforeach
													</ul>
												</div>
											@endif
										</div>
									</form>
								</div>
								{{-- Buttonbar --}}
								<div class="buttonbar">
									<button form="mobile-filters-form" type="reset">Limpiar</button>
									<button form="mobile-filters-form" type="submit">Aplicar</button>
								</div>
							</div>
						</div>
					</div>
					<div>
						<button type="button" class="button order-menu-button">
							Ordenar por: <span>{{ $order->getLabel() }}</span>
							<x-icons.chevron-down />
						</button>
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
			</div>
			<div class="books-list-container">
				@foreach($books as $book)
					<livewire:book-list-item wire:key="book-list-item-{{ $book->id }}" :book="$book" />
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
	const mobileFilterButtons = document.querySelectorAll('#filters-sidebar .with-scroll');
	const mobileFiltersContainer = document.querySelector('#filters-sidebar .level-cols');

	/* Filters */

	mobileFilterButtons.forEach(function (button)
	{
		button.addEventListener('click', function (e)
		{
			const level = parseInt(e.target.dataset.level);
			const idToShow = parseInt(e.target.dataset.show);
			console.log('ID to show: ' + idToShow);

			const currentLevel = mobileFiltersContainer.dataset.level;
			const goBack = level < currentLevel;
			const newLevel = goBack ? level : level + 1;

			if (currentLevel > 1 || newLevel > 1)
			{
				mobileFiltersContainer.classList.remove('in-level-' + currentLevel);
				mobileFiltersContainer.classList.add('in-level-' + newLevel);
			}
			else
				console.log('Nothing to do here :(');

			mobileFiltersContainer.dataset.level = newLevel;

			// For non-top levels, show selected options list
			if (newLevel !== 1 && idToShow !== undefined && !goBack)
			{
				const newLevelContainers = document.querySelectorAll('#filters-sidebar .level-col-' + newLevel + ' > .can-show');

				newLevelContainers.forEach(function (container)
				{
					console.log(container.dataset.id);

					if (idToShow == container.dataset.id)
						container.classList.add('show');
					else
						container.classList.remove('show');
				});
			}
		});
	});

	document.getElementById('filters-sidebar-active').addEventListener('change', function (e)
	{
		// No scroll when main menu sidebar is open
		if (e.target.checked)
			document.body.style.overflowY = 'hidden';
		else
			document.body.style.overflowY = 'auto';
	});

	/* Order */

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
