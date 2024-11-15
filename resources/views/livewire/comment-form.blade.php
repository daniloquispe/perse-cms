<div>
	<button type="button" wire:click="toggleForm" @class(['show-form-button', 'open' => $show])>
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
		</svg>
		Escribir un comentario
	</button>
	@if($show)
		<div wire:transition.opacity class="comment-form-wrapper">
			<form wire:submit="submit" class="comment-form">
				<h3>Agregar comentario</h3>
				{{-- Rating --}}
				<div class="stars-input-wrapper">
					<p>Califique el producto de 1 a 5 estrellas</p>
					{{-- Stars --}}
					<div class="stars-input">
						@foreach([5, 4, 3, 2, 1] as $rate)
							<input type="radio" wire:model="form.rate" value="{{ $rate }}" name="rate" id="rate-{{ $rate }}" required="required" />
							<label for="rate-{{ $rate }}">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
								</svg>
								<span class="sr-only">{{ $rate }}</span>
							</label>
						@endforeach
					</div>
					@error('form.rate')
						<div class="form-error">{{ $message }}</div>
					@enderror
				</div>
				{{-- Name --}}
				<div class="flex flex-col">
					<label for="input-name">Sus nombres y apellidos</label>
					<div>
						<input type="text" wire:model="form.name" id="input-name" required="required" />
						@error('form.name')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
				</div>
				{{-- E-mail --}}
				<div>
					<label for="input-email">Correo electrónico</label>
					<div>
						<input type="email" wire:model="form.email" id="input-email" required="required" />
						@error('form.email')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
				</div>
				{{-- Comment --}}
				<div>
					<label for="input-comment">Escribir comentario</label>
					<div>
						<textarea wire:model="form.comment" id="input-comment" rows="4" required="required"></textarea>
						@error('form.comment')
							<div class="form-error">{{ $message }}</div>
						@enderror
					</div>
				</div>
				{{-- Submit --}}
				<button type="submit">Enviar comentario</button>
			</form>
		</div>
	@endif
</div>
