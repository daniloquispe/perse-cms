<nav class="main-menu border-y border-solid border-gray-200">
	<div class="container-box">
		<ul class="flex justify-evenly">
			@foreach($items as $item)
				<li class="menu-item inline-block py-3 hover:text-palette-orange">
					<a href="{{ $item['seo_tags']['slug'] }}" class="menu-item menu-item-{{ $item['id'] }} text-sm uppercase">{{ $item['name'] }}</a>
					@if($item['id'])
						<div class="submenu hidden shadow z-10 text-left text-gray-600 transition-all">
							<p class="m-8 mb-0 text-palette-orange font-bold">{{ $item['menu_title'] ?? $item['name'] }}</p>
							<ul class="flex gap-12 px-8 py-4">
								@foreach($item['children'] as $subItem)
									<li>
										<a href="{{ $subItem['seo_tags']['slug'] }}" class="font-bold text-nowrap hover:text-palette-orange">{{ $subItem['name'] }}</a>
										<ul class="flex-col gap-0 mt-4 p-0">
											@foreach($subItem['children'] as $subItemOption)
												<li class="block mb-1 py-0"><a href="{{ $subItemOption['seo_tags']['slug'] }}" class="font-normal">{{ $subItemOption['name'] }}</a></li>
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

@assets
<style>
	.main-menu a.menu-item:after
	{
		content: ' ▾';
	}

	.main-menu a.menu-item-0:after
	{
		content: '';
	}

	.main-menu li:hover .submenu
	{
		@apply block absolute;
		@apply bg-white;
	}

	.main-menu .submenu ul ul li:last-child
	{
		@apply mb-0;
	}

	.main-menu .submenu ul ul a
	{
		text-transform: none;
	}
</style>
@endassets

@script
<script>
	const mainMenu = document.querySelectorAll('.main-menu a');

	mainMenu.forEach(function (value, key, parent)
	{
		value.addEventListener('mouseover', function (e)
		{
			const target = e.target;
			console.log(target.position);
		});
	});
</script>
@endscript
