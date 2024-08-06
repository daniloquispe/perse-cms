<div class="splide slider" aria-label="Slider">
	<div class="splide__track">
		<ul class="splide__list">
			@foreach($slides as $slide)
				<li class="splide__slide">
					<div class="image">
						@if($slide->url)
							<a href="{{ $slide->url }}"><img src="{{ $slide->image }}" alt="{{ $slide->name }}" /></a>
						@else
							<img src="{{ $slide->image }}" alt="{{ $slide->name }}" />
						@endif
					</div>
					<div class="image-mobile">
						@if($slide->url)
							<a href="{{ $slide->url }}"><img src="{{ $slide->image_mobile ?? $slide->image }}" alt="{{ $slide->name }}" /></a>
						@else
							<img src="{{ $slide->image_mobile ?? $slide->image }}" alt="{{ $slide->name }}" />
						@endif
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</div>
