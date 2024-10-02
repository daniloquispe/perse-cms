<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\SearchTerms;
use App\Queries\SearchQuery;
use App\Services\BookSearch;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchForm extends Component
{
	public string $searchString;

	public bool $canShowResetButton = false;

	public bool $showAutocompleteList = false;

	public Collection $autocompleteList;

	public int $autocompleteCount;

	#[Computed]
	public function showResetButton(): bool
	{
		return !empty($this->searchString) && $this->canShowResetButton;
	}

	public function mount(): void
	{
		if (Route::is('search'))
			$this->searchString = Route::current()->parameter('search');
	}

	public function onFocusEvent(): void
	{
		$this->canShowResetButton = true;
	}

	public function onBlurEvent(): void
	{
		$this->canShowResetButton = false;
		$this->showAutocompleteList = false;
	}

	public function autocomplete(BookSearch $bookSearch): void
	{
		if (empty($this->searchString))
			$this->showAutocompleteList = false;
		else
		{
			Bugsnag::leaveBreadcrumb('About to start a search query', metaData: ['search' => $this->searchString]);

			$bookSearch->search($this->searchString);

			$this->autocompleteList = $bookSearch->getBooks();
//			dd($this->searchString, $this->autocompleteList);
			$this->autocompleteCount = $bookSearch->getTotalCount();

			$this->showAutocompleteList = true;
		}
	}

	public function search(): void
	{
		$this->redirectRoute('search', $this->searchString);
	}
}
