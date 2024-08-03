<?php

namespace App\Livewire;

use App\Models\BookCategory;
use Illuminate\Support\Collection;
use Livewire\Component;

class BooksFilterableList extends Component
{
	public int $categoryId;

	public string $title;

	public int $count;

	public string $searchResultsLabel;

	public Collection $books;

	public function mount(): void
	{
		if (isset($this->categoryId))
		{
			$category = BookCategory::query()
				->find($this->categoryId);

			$this->title = $category->name;
			$this->books = $category->books;
			$this->count = $category->books()->count();
			$this->searchResultsLabel = $category->forced_search_results_label ?? 'libros';
		}
	}

    public function render()
    {
        return view('livewire.books-filterable-list');
    }
}
