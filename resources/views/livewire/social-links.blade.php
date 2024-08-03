<div class="footer-social-links">
	@if(count($links) > 0)
		<p class="title">Síguenos en nuestras redes</p>
		<ul>
			@foreach($links as $link)
				<li>
					<a href="{{ $link->url }}" target="_blank">
						{!! $link->svg !!}
						<span>{{ $link->name }}</span>
					</a>
				</li>
			@endforeach
		</ul>
	@endif
</div>
