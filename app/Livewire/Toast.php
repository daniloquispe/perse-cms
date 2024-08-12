<?php

namespace App\Livewire;

use Livewire\Component;

class Toast extends Component
{
	public $title;
	public $message;
	public $icon;
	public $link;
	public $linkText;

	protected $listeners = ['showToast'];

	public function showToast($title, $message = null, $icon = null, $link = null, $linkText = null): void
	{
		$this->title = $title;
		$this->message = $message;
		$this->icon = $icon;
		$this->link = $link;
		$this->linkText = $linkText;

		$this->dispatch('show-toast');
	}

	public function render()
	{
		return view('livewire.toast');
	}
}
