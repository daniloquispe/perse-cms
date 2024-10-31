<!DOCTYPE html>
<html lang="es">
<head>
	<title>@yield('title') :: {{ config('app.name') }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
</head>
<style>
	html
	{
		font-size: 16px;

		*
		{
			margin: 0;
			padding: 0;
		}
	}

	body
	{
		/*@apply container mx-auto max-w-screen-lg;*/
		{{-- @apply bg-palette-pink; --}}
		background-color: #f1e5f4;
		font-family: Roboto, Helvetica, Arial, sans-serif;

		> div
		{
			max-width: 600px;
			margin: 0.5rem auto;
			{{-- @apply bg-body-white --}}
			background-color: #fdfdfd;

			header
			{
				display: flex;
				justify-content: center;
				padding: 0.67rem 0;

				img
				{
					width: 218px;
				}
			}

			/*main
			{
				@apply border-x border-gray-200;
			}*/

			main h1
			{
				padding: 2.5rem 3.5rem;
				background-color: #9143bc;
				color: #fff;
				font-size: 2.5rem;
				font-weight: 500;
			}

			main .auth
			{
				padding: 2rem 3.5rem;
				{{-- @apply flex items-center; --}}
				display: flex;
				align-items: center;
				{{-- @apply text-gray-600; --}}
				color: rgb(75 85 99);

				svg
				{
					width: 2rem;
					height: 2rem;
				}

				> div:last-child
				{
					margin-left: 1rem;
					padding-left: 1rem;
					{{-- @apply border-r border-solid border-gray-400; --}}
					border-left: 1px solid rgb(156 163 175);
				}

				.hello
				{
					margin-bottom: 0.5rem;
					{{-- @apply text-xl text-gray-800; --}}
					font-size: 1.25rem;
					color: rgb(31 41 55);
				}
			}

			main .notes
			{
				font-size: 0.9rem;
				color: unset;

				& p:first-child
				{
					font-weight: 500;
				}
			}

			footer
			{
				{{-- @apply bg-gray-100; --}}
				background-color: rgb(243 244 246);
				{{-- @apply text-center text-gray-600; --}}
				text-align: center;
				color: rgb(75 85 99);

				> div
				{
					{{-- @apply py-12; --}}
					padding: 1.5rem;
					{{-- @apply first-of-type:border-b first-of-type:border-dotted first-of-type:border-b-gray-200; --}}

					&:first-child
					{
						border-bottom: 3px dotted rgb(229 231 235);
						font-size: 0.9rem;
					}

					a
					{
						color: #9143bc;
						text-decoration: none;
					}
				}
			}
		}
	}
</style>
@yield('styles')
<body>
<div>
	{{-- Logo --}}
	<header>
		<img src="{{ asset('images/logo-perse-librerias-principal.png') }}" alt="{{ config('app.name') }}" />
	</header>
	{{-- Main --}}
	<main>@yield('content')</main>
	{{-- Footer --}}
	<footer>
		{{-- Regards --}}
		<div>
			<p>Atentamente, <a href="{{ route('home') }}" target="_blank">{{ config('app.name') }}</a></p>
		</div>
		{{-- Copyright --}}
		<div>
			<p>Copyright &copy; {{ config('app.name') }} {{ date('Y') }}</p>
		</div>
	</footer>
</div>
</body>
</html>
