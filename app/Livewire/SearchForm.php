<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class SearchForm extends Component
{
	public string $searchString;

	public bool $canShowResetButton;

	public function mount(): void
	{
		if (Route::is('search'))
			$this->searchString = Route::current()->parameter('search');
	}

    public function render()
    {
        return view('livewire.search-form');
    }

	public function markShowResetButton(): void
	{
		$this->canShowResetButton = true;
	}

	public function markDontShowResetButton(): void
	{
		$this->canShowResetButton = false;
	}

	public function search(): void
	{
		$this->redirectRoute('search', $this->searchString);
	}
}
