<div class="card">
	@if($withHeader)
		<div class="card-header">
			<h2 class="card-title">
				@if($withBackLink)
					<a href="{{ $backUrl }}"><x-icons.back class="size-6" /></a>
				@endif
				{{ $title }}
			</h2>
			@if($subtitle)
				<p>{{ $subtitle }}</p>
			@endif
		</div>
	@endif
	<div @class(['card-body' => $hasBody])>{{ $slot }}</div>
</div>
