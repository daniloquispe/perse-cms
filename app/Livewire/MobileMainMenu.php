<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class MobileMainMenu extends Component
{
	public bool $showSidebar = false;

	public int $pageId = 0;

	public array $items;

	public array $activeIds;

    public function render(): View
    {
		$pages = $this->generateMenuPages();

		$data = compact('pages');
        return view('livewire.mobile-main-menu', $data);
    }

	private function generateMenuPages(): array
	{
		$pages = [];

		// Main page: Top-level categories
		$pages[0] = [
			'items' => $this->extractItemsFromParent(),
			'parent' => null,
		];

		return $pages;
	}

	private function extractItemsFromParent(int $parentId = null): array
	{
		$pageItems = [];

		foreach ($this->items as $pageItem)
		{
			if ($pageItem['id'] == 0)
				continue;

			$pageItems[] = $pageItem;
		}

		return $pageItems;
	}

	public function goToPage(int $pageId): void
	{
		$this->pageId = $pageId;
	}
}
