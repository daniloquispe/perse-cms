<div class="mobile-main-menu-component">
	<input type="checkbox" wire:model="showSidebar" id="main-menu-sidebar-active" />
	{{-- Open menu (mobile) --}}
	<label for="main-menu-sidebar-active" class="open-main-menu-sidebar-button">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
		</svg>
		<span class="sr-only">Menú</span>
	</label>
	<label for="main-menu-sidebar-active" id="main-menu-sidebar-overlay"></label>
	<div class="main-menu-sidebar-container">
		{{-- Close menu --}}
		<label for="main-menu-sidebar-active" class="close-main-menu-sidebar-button">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
				<path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
			</svg>
			<span class="sr-only">Cerrar</span>
		</label>
		<div>
			{{-- Scrollpane --}}
			<div @class(['level-cols', 'in-level-2' => $currentLevel == 2, 'in-level-3' => $currentLevel == 3]) data-level="1">
				@foreach($itemsByLevel as $level => $itemsInLevel)
					<div @class(['level-col', 'level-col-' . $level])>
						@foreach($itemsInLevel as $itemId => $itemsInCol)
							<div @class(['can-show' => $level > 1]) data-id="{{ $itemId }}">
								{{-- Back --}}
								@if($level > 1)
									<button type="button" class="back-button with-scroll" data-level="{{ $level - 1 }}">
										<x-icons.chevron-left />
										{{ $itemsInCol['parentLabel'] }}
									</button>
								@endif
								{{-- Menu title --}}
								<p class="menu-title">{{ $itemsInCol['title'] }}</p>
								{{-- Menu items --}}
								<ul>
									@foreach($itemsInCol['items'] as $itemInCol)
										<li class="menu-item">
											@if(array_key_exists('children', $itemInCol))
												<button type="button" class="menu-link with-scroll" data-level="{{ $level }}" data-show="{{ $itemInCol['id'] }}">
													<div data-level="{{ $level }}" data-show="{{ $itemInCol['id'] }}">{{ $itemInCol['name'] }}</div>
													<div data-level="{{ $level }}" data-show="{{ $itemInCol['id'] }}">
														<x-icons.chevron-right data-level="{{ $level }}" data-show="{{ $itemInCol['id'] }}" />
													</div>
												</button>
											@else
												<a href="{{ (new \App\Services\UrlService())->fromSlug($itemInCol['seo_tags']['slug']) }}" class="menu-link">
													{{ $itemInCol['name'] }}
												</a>
											@endif
										</li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
			@if(false)
			<div class="level-cols">
				@foreach($itemsByLevel as $level => $itemsInLevel)
					<div class="level-col">
						@foreach($itemsInLevel as $itemId => $itemsInCol)
							<div>
								{{-- Back --}}
								@if($level > 1)
									<button type="button" wire:click="goToPage({{ $pages[$currentPageId]['parentId'] }}, {{ true }})" class="back-button">
										<x-icons.chevron-left />
										{{ $pages[$currentPageId]['parentLabel'] }}
									</button>
								@endif
								{{-- Menu title --}}
								<p class="menu-title">{{ $item['title'] }}</p>
								{{-- Menu items --}}
								<ul>
									@foreach($item['items'] as $itemOption)
										<li @class(['menu-item', 'active' => in_array($itemOption['id'], $activeIds)])>
											@if(array_key_exists('children', $itemOption))
												<button type="button" wire:click="goToPage({{ $itemOption['id'] }})" class="menu-link">
													<div>{{ $itemOption['name'] }}</div>
													<div><x-icons.chevron-right /></div>
												</button>
											@else
												<a href="{{ (new \App\Services\UrlService())->fromSlug($itemOption['seo_tags']['slug']) }}" class="menu-link">
													{{ $itemOption['name'] }}
												</a>
											@endif
										</li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
			@endif
		</div>
	</div>
</div>
