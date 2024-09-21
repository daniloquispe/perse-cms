<?php

namespace App\Models;

use App\HasSearchTerms;
use App\HasSeoTags;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory, HasSearchTerms, HasSeoTags;

	protected $fillable = [
		'relevance',
		'category_id',
		'cover',
		'discounted_price',
		'is_award_winning',
		'is_presale',
		'is_recommended',
		'is_visible',
		'price',
		'publisher_id',
		'book_format_id',
		'bookbinding_type_id',
		'saga_id',
		'age_range_id',
		'slug',
		'summary',
		'title',
		'year',
	];

	protected static function boot()
	{
		parent::boot();

		static::saved(function (Book $book)
		{
			// Add/update search terms
			$terms = [
				$book->title,
				$book->isbn,
				$book->category->name,
				join('; ', $book->authors()->pluck('name')->toArray()),
			];
			$terms = join(PHP_EOL, $terms);
			$book->searchTerms()->update(compact('terms'));
		});
	}

	public function hasDiscountNow(): Attribute
	{
		if (!$this->discounted_price)
			$hasDiscount = false;
		else
		{
			if ($this->discount_from && $this->discount_to)
				$hasDiscount = Carbon::now()->between($this->discount_from, $this->discount_to);
			elseif ($this->discount_from)
				$hasDiscount = $this->discount_from < Carbon::now();
			elseif ($this->discount_to)
				$hasDiscount = Carbon::now() < $this->discount_to;
			else
				$hasDiscount = true;
		}

		return Attribute::make(fn() => $hasDiscount);
	}

	public function authors(): BelongsToMany
	{
		return $this->belongsToMany(Author::class);
	}

	public function category(): BelongsTo
	{
		return $this->belongsTo(BookCategory::class);
	}

	public function publisher(): BelongsTo
	{
		return $this->belongsTo(Publisher::class);
	}

	public function saga(): BelongsTo
	{
		return $this->belongsTo(Saga::class);
	}

	public function bookbindingType(): BelongsTo
	{
		return $this->belongsTo(BookbindingType::class);
	}

	public function ageRange(): BelongsTo
	{
		return $this->belongsTo(BookAgeRange::class, 'age_range_id');
	}

	public function bookFormat(): BelongsTo
	{
		return $this->belongsTo(BookFormat::class);
	}

	public function bookCarousels(): BelongsToMany
	{
		return $this->belongsToMany(BookCarousel::class, 'book_carousel')
			->withPivot(['order', 'can_be_visible']);
	}

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}
}
