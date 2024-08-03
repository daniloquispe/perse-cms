<div class="splide slider" aria-label="Slider">
	<div class="splide__track">
		<ul class="splide__list">
			@foreach($slides as $slide)
				<li class="splide__slide">
					@if($slide->url)
						<a href="{{ $slide->url }}"><img src="{{ $slide->image }}" alt="{{ $slide->name }}" /></a>
					@else
						<img src="{{ $slide->image }}" alt="{{ $slide->name }}" />
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</div>
