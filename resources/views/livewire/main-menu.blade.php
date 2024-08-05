<nav class="main-menu">
	<div class="container-box">
		<ul>
			@foreach($items as $item)
				<li class="menu-item">
					<a href="{{ $item['seo_tags']['slug'] }}" class="menu-item menu-item-{{ $item['id'] }}">{{ $item['name'] }}</a>
					@if($item['id'])
						<div class="submenu">
							<p class="submenu-title">{{ $item['menu_title'] ?? $item['name'] }}</p>
							<ul>
								@foreach($item['children'] as $subItem)
									<li>
										<a href="{{ $subItem['seo_tags']['slug'] }}">{{ $subItem['name'] }}</a>
										<ul>
											@foreach($subItem['children'] as $subItemOption)
												<li><a href="{{ $subItemOption['seo_tags']['slug'] }}">{{ $subItemOption['name'] }}</a></li>
											@endforeach
										</ul>
									</li>
								@endforeach
							</ul>
						</div>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</nav>
