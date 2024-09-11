@extends('layouts.main')

@section('title', $page->seoTags->meta_title)
@section('description', $page->seoTags->meta_description)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<article class="container-box-stretch content-wrapper document">
		<header>
			<h1>{{ $page->title }}</h1>
		</header>
		<main class="mx-8 xl:mx-0">
			{!! $page->content !!}
		</main>
	</article>
@endsection
