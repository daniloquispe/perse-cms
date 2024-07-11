<?php

namespace App\Filament\Resources\SagaResource\Pages;

use App\Filament\Resources\SagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSagas extends ListRecords
{
    protected static string $resource = SagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
