<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscriber extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'email',
		'phone',
		'book_category_id_1',
		'book_category_id_2',
		'book_category_id_3',
	];

	public function favoriteBookCategory1(): BelongsTo
	{
		return $this->belongsTo(BookCategory::class, 'book_category_id_1');
	}

	public function favoriteBookCategory2(): BelongsTo
	{
		return $this->belongsTo(BookCategory::class, 'book_category_id_2');
	}

	public function favoriteBookCategory3(): BelongsTo
	{
		return $this->belongsTo(BookCategory::class, 'book_category_id_3');
	}
}
