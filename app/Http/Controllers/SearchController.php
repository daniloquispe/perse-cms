<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SearchController extends Controller
{
	public function __invoke(string $searchString): View
	{
		// Breadcrumbs
		$breadcrumbs = [['text' => 'Resultados de búsqueda', 'url' => null]];

		$data = compact('searchString', 'breadcrumbs');
		return view('search', $data);
	}
}
