<div class="card">
	@if($withHeader)
		<div class="card-header">
			<h2 class="card-title">{{ $title }}</h2>
			@if($subtitle)
				<p>{{ $subtitle }}</p>
			@endif
		</div>
	@endif
	<div @class(['card-body' => $hasBody])>{{ $slot }}</div>
</div>
