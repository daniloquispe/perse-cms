@extends('layouts.main')

@section('title', 'Resultados de búsqueda')
@section('description', null)

@section('content')
	<div class="container-box">
		<x-breadcrumbs :links="$breadcrumbs" />
	</div>
	<livewire:books-filterable-list :search-string="$searchString" />
@endsection
