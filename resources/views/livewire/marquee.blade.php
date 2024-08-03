<div class="splide marquee" aria-label="Marquee">
	<div class="splide__track">
		<ul class="splide__list">
			@foreach($items as $item)
				<li class="splide__slide">
					@if($item->url)
						<a href="{{ $item->url }}"><div>{{ $item->text }}</div></a>
					@else
						{{ $item->text }}
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</div>
