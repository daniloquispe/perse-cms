<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerCard extends Component
{
	public ?string $title;

	public ?string $subtitle;

	public bool $hasBody;

	/**
     * Create a new component instance.
     */
    public function __construct(string|null $title = null, string|null $subtitle = null, bool $hasBody = true)
    {
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->hasBody = $hasBody;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
		$withHeader = $this->title != null;

		$data = compact('withHeader');
        return view('components.customer-card', $data);
    }
}
