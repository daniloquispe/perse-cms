<form wire:submit="addToCart">
	{{-- Quantity --}}
	<span class="component--quantity-input">
		<button type="button" wire:click="decrement" class="dec">&minus;</button>
		<input type="text" wire:model="quantity" class="input" />
		<button type="button" wire:click="increment" class="inc">+</button>
	</span>
	{{-- Submit --}}
	<button type="submit">Agregar al carrito</button>
</form>

@if(false)
<form wire:submit="addToCart">
	<x-form.quantity-input wire:model="quantity" />
	<button type="submit">Agregar al carrito</button>
</form>
@endif
