<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchForm extends Component
{
	public string $searchString;

	public bool $canShowResetButton;

	public bool $showAutocompleteList = false;

	public Collection $autocompleteList;

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

	public function autocomplete(): void
	{
		if (empty($this->searchString))
			$this->showAutocompleteList = false;
		else
		{
			$this->autocompleteList = Book::query()
				->where('is_visible', true)
				->where('title', 'like', "%{$this->searchString}%")
				->with('seoTags')
				->get();

			$this->showAutocompleteList = true;
		}
	}

	public function search(): void
	{
		$this->redirectRoute('search', $this->searchString);
	}
}
