<?php

namespace App\Livewire;

use App\Models\BookCarousel as BookCarouselModel;
use Livewire\Component;

class BookCarousel extends Component
{
	public BookCarouselModel $carousel;

    public function render()
    {
        return view('livewire.book-carousel');
    }
}
