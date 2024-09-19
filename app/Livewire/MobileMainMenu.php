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

	public array $items;

	public array $activeIds;

	public array $pages;

	public function mount(): void
	{
		$this->urlService = new UrlService();

		$this->generateMenuPages();
	}

    public function render(): View
    {
		return view('livewire.mobile-main-menu');
    }

	private function generateMenuPages(): void
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
				'parentLabel' => 'Volver al menú',
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

		$this->pages = $pages;//dd($pages);
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

	public function goToPage(int $pageId): void
	{
		$this->currentPageId = $pageId;
	}
}
