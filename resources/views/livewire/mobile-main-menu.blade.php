<div class="mobile-main-menu-component">
	<input type="checkbox" wire:model="showSidebar" id="main-menu-sidebar-active" />
	{{-- Open/close menu (mobile) --}}
	<label for="main-menu-sidebar-active" class="open-main-menu-sidebar-button">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
		</svg>
		<span class="sr-only">Menú</span>
	</label>
	<label for="main-menu-sidebar-active" id="main-menu-sidebar-overlay"></label>
	<div class="main-menu-sidebar-container">
		{{-- Close --}}
		<label for="main-menu-sidebar-active" class="close-main-menu-sidebar-button">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
				<path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
			</svg>
			<span class="sr-only">Cerrar</span>
		</label>
		<div class="menu-page">
			{{-- Back --}}
			@if($pages[$currentPageId]['parentId'] !== null)
				<button type="button" wire:click="goToPage({{ $pages[$currentPageId]['parentId'] }})" class="back-button">
					<x-icons.chevron-left />
					{{ $pages[$currentPageId]['parentLabel'] }}
				</button>
			@endif
			{{-- Menu title --}}
			<p class="menu-title">{{ $pages[$currentPageId]['title'] }}</p>
			{{-- Menu items --}}
			<ul>
				@foreach($pages[$currentPageId]['items'] as $item)
					<li @class(['menu-item', 'active' => in_array($item['id'], $activeIds)])>
						@if(array_key_exists('children', $item))
							<button type="button" wire:click="goToPage({{ $item['id'] }})" class="menu-link">
								<div>{{ $item['name'] }}</div>
								<div><x-icons.chevron-right /></div>
							</button>
						@else
							<a href="{{ (new \App\Services\UrlService())->fromSlug($item['seo_tags']['slug']) }}" class="menu-link">
								{{ $item['name'] }}
							</a>
						@endif
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
