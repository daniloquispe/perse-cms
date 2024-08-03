@extends('layouts.main')

@section('title', $category->seoTags->meta_title)
@section('description', $category->seoTags->meta_description)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	@if(false)
	<livewire:books-search-results :category-id="$category->id" :title="$category->name" :search-results-label="$category->forced_search_results_label ?? 'libros'" />
	@endif
	<livewire:books-filterable-list :category-id="$category->id" />
@endsection
