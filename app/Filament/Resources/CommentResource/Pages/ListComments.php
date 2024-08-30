<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\CommentStatus;
use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

	public function getTabs(): array
	{
		$tabs = [];

		foreach (CommentStatus::cases() as $status)
			$tabs[$status->name] = Tab::make($status->getLabel() . 's')
				->modifyQueryUsing(fn(Builder $query) => $query->where('status', $status));

		$tabs[] = Tab::make('Todos');

		return $tabs;
	}
}
