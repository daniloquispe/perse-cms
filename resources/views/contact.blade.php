@extends('layouts.main')

@section('title', $page->seoTags->meta_title)
@section('description', $page->seoTags->meta_description)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<article class="container-box-stretch content-wrapper contact-page document">
		<header>
			<h1>{{ $page->name }}</h1>
		</header>
		<main class="grid grid-cols-2 gap-8 items-center">
			<div>
				<img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->name }}" class="max-w-full" />
			</div>
			<div>
				<div>{!! $page->content !!}</div>
				<form>
					{{-- Name --}}
					<div class="form-row">
						<input type="text" id="input-name" name="name" placeholder="Tu nombre *" required="required" aria-label="Tu nombre" />
					</div>
					{{-- E-mail --}}
					<div class="form-row">
						<input type="email" id="input-email" name="email" placeholder="Correo electrónico *" required="required" aria-label="Correo electrónico" />
					</div>
					{{-- Phone --}}
					<div class="form-row">
						<input type="tel" id="input-phone" name="phone" placeholder="Teléfono" required="required" aria-label="Teléfono" />
					</div>
					{{-- Message --}}
					<div class="form-row">
						<textarea rows="5" id="input-message" name="message" placeholder="Mensaje *" required="required" aria-label="Mensaje"></textarea>
					</div>
					{{-- Acceptance --}}
					<div class="form-row">
						<ul>
							<li>
								<div>
									<input type="checkbox" id="accept-1" />
								</div>
								<label for="accept-1">He leído y autorizo el tratamiento de mis datos según la <a href="/politicas/politicas-de-privacidad">Política de Privacidad de Persé Librerías</a></label>
							</li>
							<li>
								<div>
									<input type="checkbox" id="accept-2" />
								</div>
								<label for="accept-2">Autorizo el tratamiento de mis datos con fines publicitarios según la <a href="/politicas/politicas-de-privacidad">Política de Privacidad de Persé Librerías</a></label>
							</li>
						</ul>
					</div>
					{{-- Submit --}}
					<div class="form-row">
						<button>Enviar</button>
					</div>
				</form>
			</div>
		</main>
	</article>
@endsection