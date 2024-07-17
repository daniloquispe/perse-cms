<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $owner_id
 * @property string $owner_type
 * @property string $slug
 * @property-read Page $owner
 */
class SeoTags extends Model
{
    use HasFactory;

	protected $table = 'seo_tags';

	protected $fillable = ['slug', 'meta_title', 'meta_description'];

	public function owner(): MorphTo
	{
		return $this->morphTo();
	}
}
