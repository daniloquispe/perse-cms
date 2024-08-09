<?php

namespace App\Livewire;

use Livewire\Component;

class SearchForm extends Component
{
	public string $searchString;

    public function render()
    {
        return view('livewire.search-form');
    }

	public function search(): void
	{
		$this->redirectRoute('search', $this->searchString);
	}
}
