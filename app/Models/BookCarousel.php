<?php

namespace App\Models;

use App\BookCarouselZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCarousel extends Model
{
	protected $fillable = ['order', 'title', 'zone', 'is_visible'];

	protected $casts = ['zone' => BookCarouselZone::class];

	public function books(): BelongsToMany
	{
		return $this->belongsToMany(Book::class, 'book_carousel')
			->withPivot(['order', 'can_be_visible']);
	}

	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}
}
