<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SearchTerms extends Model
{
	protected $table = 'search_terms';

	protected $fillable = ['terms'];

	public function searchable(): MorphTo
	{
		return $this->morphTo();
	}
}
