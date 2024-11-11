<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class AvatarIndicator extends Component
{
	use WithFileUploads;

	public $newAvatar;

	public function render()
    {
        return view('livewire.avatar-indicator');
    }

	public function uploadImage(): void
	{
		$this->newAvatar->store(path: 'customers');
	}
}
