@extends('mail.mail-layout')

@section('title', '¿Olvidaste algo? 🤔☺️')

@section('styles')
	<style>
		.image-header
		{
			width: 100%;
			height: auto;
		}

		section.hello
		{
			padding: 0 4rem 1rem;

			> p:first-child
			{
				margin: 1rem 0;
				font-size: 1.8rem;
				text-align: center;
			}
		}

		.products-list
		{
			padding: 1rem 8rem;

			.products-list-item
			{
				display: flex;
				align-items: center;
				gap: 1.5rem;
				margin-bottom: 1rem;

				&:last-child
				{
					margin-bottom: 0;
				}

				img
				{
					width: 7rem;
					height: auto;
				}

				.book-info
				{
					p
					{
						font-size: 0.9rem;
						margin-bottom: 0.6rem;

						&:last-child
						{
							margin-bottom: 0;
						}
					}

					p.title
					{
						font-weight: 500;
						text-transform: uppercase;
					}

					p span
					{
						font-weight: 500;
					}
				}
			}
		}

		.cta
		{
			margin: 1rem 0 2rem;
			text-align: center;

			.cta-button
			{
				display: inline-block;
				width: auto;
				margin: 0 auto;
				padding: 0.5rem 2rem;
				border-radius: 0.4rem;
				background-color: #9143bc;
				color: #fff;
				font-weight: 500;
				text-decoration: none;
			}
		}
	</style>
@endsection

@section('content')
	<div>
		<img src="{{ asset('images/mail/olvidaste-algo.png') }}" alt="¿Olvidaste algo?" class="image-header" />
	</div>
	<section class="hello">
		<p>Hola {{ $customer->first_name }}, notamos que olvidaste algo en tu carrito 🤗🛒</p>
		<p>¡Adquiérelos antes de que se agoten!</p>
	</section>
	<section class="products-list">
		@foreach($books as $book)
			<div class="products-list-item">
				<img src="{{ (new \App\Services\UrlService())->fromAsset($book->cover_or_placeholder) }}" alt="{{ $book->title }}" />
				<div class="book-info">
					<p class="title">{{ $book->title }}</p>
					<p><span>Quantity:</span> 1</p>
					<p><span>Total:</span> S/&nbsp;{{ $book->price }}</p>
				</div>
			</div>
		@endforeach
	</section>
	<section class="cta">
		<a href="#" class="cta-button">Finalizar compra</a>
	</section>
@endsection
