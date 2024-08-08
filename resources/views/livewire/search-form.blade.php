<form class="search-form">
	<input type="search" wire:model.live="searchString" id="s" placeholder="Busca por título, autor, género o ISBN" aria-label="Buscar" />
	<button type="reset" style="{{ $searchString ? 'visibility: visible' : 'visibility: hidden' }}">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
		</svg>
		<span>Borrar</span>
	</button>
	<button type="submit">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
		</svg>
		<span>Buscar</span>
	</button>
</form>
