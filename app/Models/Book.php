<?php

namespace App\Models;

use App\HasSeoTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory, HasSeoTags;

	protected $fillable = [
		'category_id',
		'cover',
		'is_presale',
		'is_visible',
		'price',
		'publisher_id',
		'format_id',
		'saga_id',
		'age_range_id',
		'slug',
		'summary',
		'title',
		'year',
	];

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

	public function format(): BelongsTo
	{
		return $this->belongsTo(BookFormat::class, 'format_id');
	}

	public function ageRange(): BelongsTo
	{
		return $this->belongsTo(BookAgeRange::class, 'age_range_id');
	}
}
