<?php

namespace App\Models;

use App\HasSeoTags;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

/**
 * @property string $name
 */
class BookCategory extends Model
{
    use HasFactory, HasSeoTags, ModelTree;

	protected $fillable = [
		'is_visible',
		'menu_title',
		'name',
		'order',
		'parent_id',
		'search_results_label',
	];

	public function forcedSearchResultsLabel(): Attribute
	{
		return Attribute::make(function ()
		{
			if (!$this->parent_id)
				return $this->search_results_label;

			if (!$this->search_results_label && $this->parent_id)
			{
				$parent = static::query()
					->select(['id', 'parent_id', 'search_results_label'])
					->whereKey($this->parent_id)
					->first();

				if (!$parent)
					return null;

				if (!$parent->search_results_label && $parent->parent_id)
				{
					$parentParent = static::query()
						->select(['id', 'parent_id', 'search_results_label'])
						->whereKey($parent->parent_id)
						->first();

					return $parentParent ? $parentParent->search_results_label : null;
				}
			}
		});
	}

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
