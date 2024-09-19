<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class MainMenu extends Component
{
	public array $items;

	public array $activeIds;

    public function render(): View
    {
        return view('livewire.main-menu');
    }




}
