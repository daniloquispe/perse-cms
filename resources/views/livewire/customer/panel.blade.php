<div class="flex flex-col lg:grid lg:grid-cols-5 gap-4">
	{{-- Sidebar --}}
	<nav class="card">
		{{-- Avatar --}}
		<livewire:avatar-indicator />
		{{-- Menu --}}
		<ul class="menu">
			@foreach($menuRoutes as $menuRoute)
				<li wire:key="{{ $menuRoute['route'] }}" @class(['active' => \Illuminate\Support\Facades\Route::is($menuRoute['route'])])>
					<a wire:click="$activeMenuItemIndex = $i" href="{{ route($menuRoute['route']) }}">
						{{ $menuRoute['name'] }}
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
						</svg>
					</a>
				</li>
			@endforeach
			<li><a wire:click.prevent="logout" href="/customer/logout">Cerrar sesión</a></li>
		</ul>
	</nav>
	{{-- Center --}}
	<div class="lg:col-span-4">
		@switch(\Illuminate\Support\Facades\Route::current()->action['as'])
			@case('customer.profile')
				<livewire:customer.profile-section />
				@break
			@case('customer.addresses')
				<livewire:customer.addresses-section />
				@break
			@case('customer.orders')
				<livewire:customer.orders-section />
				@break
			@case('customer.order')
				<livewire:customer.order-section :order="\Illuminate\Support\Facades\Route::current()->parameter('order')" />
				@break
			@case('customer.favorites')
				<livewire:customer.favorites-section />
				@break
		@endswitch
	</div>
</div>
