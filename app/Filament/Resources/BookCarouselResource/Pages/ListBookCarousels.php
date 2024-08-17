<?php

namespace App\Filament\Resources\BookCarouselResource\Pages;

use App\BookCarouselZone;
use App\Filament\Resources\BookCarouselResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListBookCarousels extends ListRecords
{
    protected static string $resource = BookCarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

	public function getTabs(): array
	{
		$tabs = [];

		foreach (BookCarouselZone::cases() as $zone)
			$tabs[$zone->name] = Tab::make($zone->getLabel())
				->modifyQueryUsing(fn(Builder $query) => $query->where('zone', $zone));

		return $tabs;
	}
}
