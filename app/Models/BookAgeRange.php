<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookAgeRange extends Model
{
    use HasFactory;

	protected $fillable = ['name'];

	public function books(): HasMany
	{
		return $this->hasMany(Book::class, 'age_range_id');
	}
}
