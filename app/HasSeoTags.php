<?php

namespace App;

use App\Models\SeoTags;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property-read SeoTags $seoTags
 */
trait HasSeoTags
{
	public function seoTags(): MorphOne
	{
		return $this->morphOne(SeoTags::class, 'owner');
	}
}
