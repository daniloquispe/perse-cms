<?php

namespace App;

use Livewire\Features\SupportEvents\Event;
use Livewire\Features\SupportEvents\HandlesEvents;

trait Toast
{
	use HandlesEvents;

	public function toast($title, $message = null, $icon = null, $link = null, $linkText = null): Event
	{
		return $this->dispatch('showToast', $title, $message, $icon, $link, $linkText);
	}
}
