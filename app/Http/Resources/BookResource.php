<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
		return [
			'sku' => $this->sku,
			'isbn' => $this->isbn,
			'cover' => asset('storage/' . $this->cover),
			'title' => $this->title,
			'summary' => $this->summary,
			'year' => $this->year,
			'pages_count' => $this->pages_count,
			'weight' => $this->weight,
			'width' => $this->width,
			'height' => $this->height,
			'price' => $this->price,
			'discounted_price' => $this->discounted_price,
			'is_presale' => $this->is_presale,
			'authors' => AuthorResource::collection($this->authors),
			'publisher' => new PublisherResource($this->publisher),
			'seo_tags' => $this->seoTags,
		];
    }
}
