<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name Author's full name
 * @property string $photo Author's photo filename
 */
class Author extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'summary', 'photo'];

	public function books(): BelongsToMany
	{
		return $this->belongsToMany(Book::class);
	}
}
