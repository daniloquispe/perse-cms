<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCategory extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'slug', 'order', 'is_visible'];

	public function parent(): BelongsTo
	{
		return $this->belongsTo(static::class, 'parent_id');
	}

	public function children(): HasMany
	{
		return $this->hasMany(static::class, 'parent_id');
	}

	public function books(): HasMany
	{
		return $this->hasMany(Book::class, 'category_id');
	}
}
