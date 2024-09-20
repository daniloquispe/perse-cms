<?php

namespace App\Livewire;

use App\Services\UrlService;
use Illuminate\View\View;
use Livewire\Component;

class MobileMainMenu extends Component
{
	private UrlService $urlService;

	public bool $showSidebar = false;

	public int $currentPageId = 0;

	public int $currentLevel = 1;

	public array $items;

	public array $activeIds;

	public array $pages;

	public array $itemsByLevel;

	public function mount(): void
	{
		$this->urlService = new UrlService();

//		$this->generateMenuPages();
		$this->generateItemsByLevel();
	}

    public function render(): View
    {
		return view('livewire.mobile-main-menu');
    }

	/*private function generateMenuPages(): void
	{
		$pages = [];

		// Main page: Top-level (level 1) categories
		$pages[0] = [
			'title' => 'Categorías',
			'items' => $this->extractItemsFromParent(),
			'parentId' => null,
			'parentLink' => null,
			'parentLabel' => null,
		];

		// Sub-categories (levels 2 and 3)
		foreach ($this->items as $item)
		{
			if (count($item['children']) == 0)
				continue;

			$pages[$item['id']] = [
				'title' => $item['name'],
				'items' => $this->extractItemsFromParent($item['children']),
				'parentId' => 0,
				'parentLink' => $this->urlService->fromSlug($item['seo_tags']['slug']),
				'parentLabel' => 'Volver a Categorías',
			];

			foreach ($item['children'] as $itemChild)
			{
				$pages[$itemChild['id']] = [
					'title' => $itemChild['name'],
					'items' => $this->extractItemsFromParent($itemChild['children']),
					'parentId' => $item['id'],
					'parentLink' => $this->urlService->fromSlug($itemChild['seo_tags']['slug']),
					'parentLabel' => "Volver a {$item['name']}",
				];
			}
		}

		$this->pages = $pages;
	}*/

	private function generateItemsByLevel(): void
	{
		$itemsByLevel = [];  // Level, itemId, info

		// Level 1
		$itemsByLevel[1][0] = [
			'title' => 'Categorías',
			'items' => $this->extractItemsFromParent(),
			'parentId' => null,
			'parentLink' => null,
			'parentLabel' => null,
		];

		// Level 2
		foreach ($this->items as $item)
		{
			if (count($item['children']) == 0)
				continue;

			$itemsByLevel[2][$item['id']] = [
				'title' => $item['name'],
				'items' => $this->extractItemsFromParent($item['children']),
				'parentId' => 0,
				'parentLink' => $this->urlService->fromSlug($item['seo_tags']['slug']),
				'parentLabel' => 'Volver a Categorías',
			];

			// Level 3
			foreach ($item['children'] as $itemChild)
			{
				$itemsByLevel[3][$itemChild['id']] = [
					'title' => $itemChild['name'],
					'items' => $this->extractItemsFromParent($itemChild['children']),
					'parentId' => $item['id'],
					'parentLink' => $this->urlService->fromSlug($itemChild['seo_tags']['slug']),
					'parentLabel' => "Volver a {$item['name']}",
				];
			}
		}

		$this->itemsByLevel = $itemsByLevel;//dd($this->itemsByLevel);
	}

	private function extractItemsFromParent(array $parentItems = null): array
	{
		if (!$parentItems)
			$parentItems = $this->items;

		$pageItems = [];

		foreach ($parentItems as $pageItem)
		{
			if ($pageItem['id'] == 0)
				continue;

			$pageItems[] = $pageItem;
		}

		return $pageItems;
	}

	/*public function goToPage(int $pageId, bool $toParent = false): void
	{
		$toParent ? $this->currentLevel-- : $this->currentLevel++;

		$this->currentPageId = $pageId;
	}*/
}
