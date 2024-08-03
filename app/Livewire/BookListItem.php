<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class BookListItem extends Component
{
	public string $url;

	public string $cover;

	public string $title;

	public Collection|string $authors;

	public float $price;

	public float|null $discountedPrice;

	public bool $isPresale = false;

	public function mount()
	{
		$authors = [];

		foreach ($this->authors as $author)
		{
			if (is_array($author))
				$authors[] = $author->name;
			else
				$authors[] = $author;
		}

		$this->authors = join(', ', $authors);
	}

    public function render()
    {
		if ($this->discountedPrice)
		{
			$discount = 100 * ($this->price - $this->discountedPrice) / $this->price;
			$data = ['discount' => round($discount)];
		}
		else
			$data = [];

        return view('livewire.book-list-item', $data);
    }
}
