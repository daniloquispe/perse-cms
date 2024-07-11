<?php

namespace App\Models;

use App\PageRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read bool $can_have_content
 * @property-read bool $can_have_slug
 * @property-read int $id Page ID and {@see PageRole role}
 */
class Page extends Model
{
    use HasFactory;

	protected $fillable = [
		'content',
		'image',
		'is_visible',
		'meta_title',
		'name',
		'slug',
		'title',
	];

	public function canHaveContent(): Attribute
	{
		return Attribute::make(function ()
		{
			return $this->id != PageRole::Home->value;
		});
	}

	public function canHaveSlug(): Attribute
	{
		return Attribute::make(function ()
		{
			return $this->id != PageRole::Home->value;
		});
	}
}
