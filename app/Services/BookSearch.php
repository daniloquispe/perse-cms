<?php

namespace App\Services;

use App\Models\Book;
use App\Models\SearchTerms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BookSearch
{
	private Builder $query;

	private Collection $results;

	private int $totalCount;

	private function query(string $search): Builder
	{
		if (!isset($this->query))
			$this->query = SearchTerms::query()
				->selectRaw('searchable_type, searchable_id, MATCH (terms) AGAINST (? with query expansion) AS relevance', [$search])
				->where('searchable_type', Book::class)
				->whereRaw('MATCH (terms) AGAINST (? with query expansion)', $search)
				->orderByDesc('relevance')
				->with([
					'searchable' => function (MorphTo $query)
					{
						$query
							->where('is_visible', true)
							->with(['publisher', 'authors', 'ageRange', 'bookbindingType', 'seoTags']);
					}
				]);

		return $this->query;
	}

	public function search(string $search, int $max = 5): void
	{
		unset($this->query);

		$this->results = $this->query($search)->take($max)->get();
		$this->totalCount = $this->query($search)->count();
	}

	/**
	 * @return Collection<SearchTerms>
	 */
	public function getResults(): Collection
	{
		return $this->results;
	}

	/**
	 * @return Collection<Book>
	 */
	public function getBooks(): Collection
	{
		return $this->getResults()->map(fn(SearchTerms $searchTerms) => $searchTerms->searchable);
	}

	public function getTotalCount(): int
	{
		return $this->totalCount;
	}
}
