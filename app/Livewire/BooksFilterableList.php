<?php

namespace App\Livewire;

use App\BookSearchResultsOrder;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\SearchTerms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Livewire\Component;

class BooksFilterableList extends Component
{
	const PAGE_SIZE = 20;

	public int $pageNumber = 1;

	public int $categoryId;

	public string $searchString;

	public string $title;

	public int $count;

	private Builder|HasMany $countQuery;

	public string $searchResultsLabel;

	public array $selectedPublisherFilters;

	public array $selectedAuthorFilters;

	public array $selectedAgeRangeFilters;

	public array $selectedBookbindingTypeFilters;

	public Collection $books;

	public BookSearchResultsOrder $order;

	private Builder|HasMany $booksQuery;

	public array $publisherFilters;

	public array $authorFilters;

	public array $ageRangeFilters;

	public array $formatFilters;

	public function mount(): void
	{
		$this->selectedPublisherFilters = [];
		$this->selectedAuthorFilters = [];
		$this->selectedAgeRangeFilters = [];
		$this->selectedBookbindingTypeFilters = [];

		$this->order = BookSearchResultsOrder::ByRelevance;

		$this->loadBooks();
	}

    /*public function render()
    {
        return view('livewire.books-filterable-list');
    }*/

	public function loadMoreBooks(): void
	{
		$this->pageNumber++;

		$this->loadBooks();
	}

	public function loadBooks(): void
	{
		$count = $this->pageNumber * self::PAGE_SIZE;

		$isBookCategory = isset($this->categoryId);
		$isSearch = isset($this->searchString);

		// Book category?
		if ($isBookCategory)
		{
			$bookCategory = BookCategory::query()
				->find($this->categoryId);

			$this->title = $bookCategory->name;
			$this->countQuery = $bookCategory->books();
			$this->searchResultsLabel = $bookCategory->forced_search_results_label ?? 'libros';

			$this->booksQuery = $bookCategory->books();
		}
		// Search results?
		elseif ($isSearch)
		{
			$this->title = "Buscando: {$this->searchString}";
			$this->countQuery = $this->newSearchQuery();
			$this->searchResultsLabel = 'libros';

			$this->booksQuery = $this->newSearchQuery();
		}

		// Order by
		switch ($this->order)
		{
			case BookSearchResultsOrder::Latest:
				$orderColumn = 'created_at';
				$orderDirection = 'desc';
				break;

			case BookSearchResultsOrder::ByPriceAscending:
				$orderColumn = 'price';
				$orderDirection = 'asc';
				break;

			case BookSearchResultsOrder::ByPriceDescending:
				$orderColumn = 'price';
				$orderDirection = 'desc';
				break;

			case BookSearchResultsOrder::ByTitleAscending:
				$orderColumn = 'title';
				$orderDirection = 'asc';
				break;

			case BookSearchResultsOrder::ByTitleDescending:
				$orderColumn = 'title';
				$orderDirection = 'desc';
				break;

			default:  // By relevance
				$orderColumn = 'relevance';
				$orderDirection = 'desc';
		}

		// Filters
		foreach ([$this->booksQuery, $this->countQuery] as $query)
			$query
				->when(count($this->selectedPublisherFilters) > 0, fn(Builder $query) => $query->whereIn('publisher_id', $this->selectedPublisherFilters))
				->when(count($this->selectedAuthorFilters) > 0, function (Builder $query)
				{
					$query->whereHas('authors', fn(Builder $query) => $query->whereIn('author_id', $this->selectedAuthorFilters));
				})
				->when(count($this->selectedAgeRangeFilters) > 0, fn(Builder $query) => $query->whereIn('age_range_id', $this->selectedAgeRangeFilters))
				->when(count($this->selectedBookbindingTypeFilters) > 0, fn(Builder $query) => $query->whereIn('bookbinding_type_id', $this->selectedBookbindingTypeFilters));

		// Get books list
		if ($isSearch)
		{
			$booksSearchTerms = $this->booksQuery
				->orderBy($orderColumn, $orderDirection)
				->take($count)
				->get();

			$this->books = new Collection();

			$booksSearchTerms->each(function (SearchTerms $bookSearchTerms)
			{
				$book = $bookSearchTerms->searchable;
				$book->relevance = $bookSearchTerms->relevance;

				$this->books->add($book);
			});
		}
		else
		{
			$this->books = $this->booksQuery
				->with(['publisher', 'authors', 'ageRange', 'bookFormat', 'bookbindingType'])
				->orderBy($orderColumn, $orderDirection)
				->take($count)
				->get();
		}

		$this->count = $this->countQuery->count();

		$this->updateFiltersLists();
	}

	private function newSearchQuery(): Builder
	{
		return SearchTerms::query()
			->selectRaw('searchable_type, searchable_id, MATCH (terms) AGAINST (? with query expansion) AS relevance', [$this->searchString])
			->where('searchable_type', Book::class)
			->whereRaw('MATCH (terms) AGAINST (? with query expansion)', [$this->searchString])
			->orderByDesc('relevance')
			->with([
				'searchable' => function (MorphTo $query)
				{
					$query
						->where('is_visible', true)
						->with(['publisher', 'authors', 'ageRange', 'bookbindingType', 'seoTags']);
				}
			]);
	}

	private function updateFiltersLists(): void
	{
		$this->publisherFilters = [];
		$this->authorFilters = [];
		$this->ageRangeFilters = [];
		$this->formatFilters = [];

		$this->books->each(function (Book $book)
		{
			// Publishers
			$publisher = $book->publisher;
			if ($publisher && !array_key_exists($publisher->id, $this->publisherFilters) && count($this->publisherFilters) < 4)
				$this->publisherFilters[$publisher->id] = $publisher->name;

			// Authors
			foreach ($book->authors as $author)
				if (!array_key_exists($author->id, $this->authorFilters) && count($this->authorFilters) < 4)
					$this->authorFilters[$author->id] = $author->name;

			// Age ranges
			$ageRange = $book->ageRange;
			if ($ageRange && !array_key_exists($ageRange->id, $this->ageRangeFilters) && count($this->ageRangeFilters) < 4)
				$this->ageRangeFilters[$ageRange->id] = $ageRange->name;

			// Formats
			$format = $book->format;
			if ($format && !array_key_exists($format->id, $this->formatFilters) && count($this->formatFilters) < 4)
				$this->formatFilters[$format->id] = $format->name;
		});
	}

	public function applyFilters(): void
	{
		$this->loadBooks();
	}
}
