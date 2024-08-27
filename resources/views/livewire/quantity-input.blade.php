<div class="quantity-input">
	<button type="button" wire:click="decrement" class="dec">&ndash;</button>
	<input type="text" wire:model="value" wire:change="checkValue" min="1" pattern="[1-9][0-9]*" />
	<button type="button" wire:click="increment" class="inc">+</button>
</div>
