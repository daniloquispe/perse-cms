<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
		return [
			'id' => $this->id,
			'name' => $this->name,
			'search_results_label' => $this->forced_search_results_table,
			'parent' => new static($this->parent),
			'seoTags' => $this->seoTags,
		];
    }
}
