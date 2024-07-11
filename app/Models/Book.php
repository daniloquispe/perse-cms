<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

	protected $fillable = [
		'category_id',
		'cover',
		'is_presale',
		'is_visible',
		'meta_title',
		'meta_description',
		'price',
		'publisher_id',
		'saga_id',
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
}
