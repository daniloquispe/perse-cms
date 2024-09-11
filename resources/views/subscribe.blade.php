@extends('layouts.main')

@section('title', $page->seoTags->meta_title)
@section('description', $page->seoTags->meta_description)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<article class="container-box-stretch content-wrapper contact-page document">
		<header>
			<h1>{{ $page->title }}</h1>
		</header>
		<main class="grid grid-cols-2 gap-8 items-center">
			<div>
				<img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->name }}" class="max-w-full" />
			</div>
			<div>
				<div>{!! $page->content !!}</div>
				<livewire:forms.subscription-form />
			</div>
		</main>
	</article>
@endsection
