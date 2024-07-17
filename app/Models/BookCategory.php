<?php

namespace App\Models;

use App\HasSeoTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class BookCategory extends Model
{
    use HasFactory, HasSeoTags, ModelTree;

	protected $fillable = ['name', 'parent_id', 'order', 'is_visible'];

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

	public static function defaultParentKey()
	{
		return null;
	}

	public function determineTitleColumnName(): string
	{
		return 'name';
	}
}
