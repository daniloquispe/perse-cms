<?php

namespace App\Services;

use App\Models\Page;
use App\Models\SeoTags;
use App\PageRole;
use Illuminate\Database\Eloquent\Builder;

class UrlService
{
	public function fromPageRole(PageRole|int $role): string|null
	{
		if ($role instanceof PageRole)
			$role = $role->value;

		if ($role == PageRole::Home->value)
			return route('home');

		$slug = SeoTags::query()
			->where('owner_type', Page::class)
			->whereHas('owner', function (Builder $query) use ($role): Builder
			{
				return $query->where('is_visible', true)->whereKey($role);
			})
			->value('slug');

		return $this->fromSlug($slug);
	}

	public function fromSlug(?string $slug): string|null
	{
		return $slug ? url($slug) : null;
	}

	public function fromAsset(?string $asset): string|null
	{
		return $asset ? asset($asset) : null;
	}
}
