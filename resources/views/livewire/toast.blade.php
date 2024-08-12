<div x-data="{ show: false }"
	 x-show="show"
	 x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
	 x-transition:enter-start="translate-y-full opacity-0"
	 x-transition:enter-end="translate-y-0 opacity-100"
	 x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
	 x-transition:leave-start="translate-y-0 opacity-100"
	 x-transition:leave-end="translate-y-full opacity-0"
	 x-init="@this.on('show-toast', () => { show = true; setTimeout(() => show = false, 15000); })"
	 class="fixed bottom-0 left-0 m-4 p-4 bg-gray-800 text-gray-200 shadow-lg rounded-lg flex items-center space-x-4">
	@if($icon)
		<img src="{{ $icon }}" alt="Icon" class="w-6 h-6">
	@endif
	<div>
		<h4 class="font-bold">{{ $title }}</h4>
		@if($message)
			<p>{{ $message }}</p>
		@endif
		@if($link)
			<a href="{{ $link }}" class="text-blue-500">{{ $linkText }}</a>
		@endif
	</div>
	<button @click="show = false" class="ml-auto text-gray-500">&times;</button>
</div>
