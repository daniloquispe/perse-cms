<div class="flex items-start">
	@foreach([1, 2, 3, 4, 5] as $starValue)
		<svg @class(['size-6', 'text-transparent', 'fill-gray-300' => ($starValue > $rate), 'fill-palette-yellow' => ($starValue <= $rate)]) xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			@if($starValue - 0.5 == $rate)
				<defs>
					<linearGradient id="half-half" x1="0%" y1="0%" x2="100%" y2="0%">
						<stop offset="50%" style="stop-color: #ffc629; stop-opacity: 1" />
						<stop offset="50%" style="stop-color: #d1d5db; stop-opacity: 1" />
					</linearGradient>
				</defs>
			@endif
			<path @if($starValue - 0.5 == $rate) fill="url(#half-half)" @endif stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
		</svg>
	@endforeach
	<span class="sr-only">Calificación: {{ $rate }}</span>
</div>
