<?php

namespace App;

use App\Models\SearchTerms;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSearchTerms
{
	public function searchTerms(): MorphOne
	{
		return $this->morphOne(SearchTerms::class, 'searchable');
	}
}
