<?php

namespace App\Models;

use App\HasSeoTags;
use App\PageRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model for an information page.
 *
 * @property string $title Page on-page title
 * @property-read bool $has_content
 * @property-read bool $has_slug
 * @property-read bool $has_title
 * @property-read int $id Page ID and {@see PageRole role}
 * @property-read PageRole $role
 * @see PageRole
 */
class Page extends Model
{
    use HasFactory, HasSeoTags;

	protected $fillable = [
		'content',
		'image',
		'is_visible',
		'name',
		'title',
	];

	public function role(): Attribute
	{
		return Attribute::make(fn() => PageRole::from($this->id));
	}

	public function hasContent(): Attribute
	{
		return Attribute::make(function ()
		{
			return !in_array($this->id, [PageRole::Home->value, PageRole::Login->value, PageRole::Register->value]);
		});
	}

	public function hasSlug(): Attribute
	{
		return Attribute::make(function ()
		{
			return $this->id != PageRole::Home->value;
		});
	}

	public function hasTitle(): Attribute
	{
		return Attribute::make(function ()
		{
			return !in_array($this->id, [PageRole::Home->value, PageRole::Login->value, PageRole::Register->value]);
		});
	}
}
