<nav class="main-menu">
	<div class="container-box main-menu-container">
		<ul>
			@foreach($items as $item)
				<li @class(['menu-item', 'active' => in_array($item['id'], $activeIds)])>
					<a href="{{ (new \App\Services\UrlService())->fromSlug($item['seo_tags']['slug']) }}" class="menu-item menu-item-{{ $item['id'] }}">
						<div>
							{{ $item['name'] }}
							@if($item['id'])
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
								</svg>
							@endif
						</div>
					</a>
					@if($item['id'])
						<div class="submenu">
							<div class="submenu-container">
								<ul>
									@foreach($item['children'] as $subItem)
										<li @class(['active' => in_array($subItem['id'], $activeIds)])>
											<a href="{{ (new \App\Services\UrlService())->fromSlug($subItem['seo_tags']['slug']) }}" class="col-title">{{ $subItem['name'] }}</a>
											<ul>
												@foreach($subItem['children'] as $subItemOption)
													<li @class(['submenu-item-option', 'active' => in_array($subItemOption['id'], $activeIds)])>
														<a href="{{ (new \App\Services\UrlService())->fromSlug($subItemOption['seo_tags']['slug']) }}">{{ $subItemOption['name'] }}</a>
													</li>
												@endforeach
											</ul>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</nav>
