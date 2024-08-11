<?php

namespace App\Filament\Resources\BookbindingTypeResource\Pages;

use App\Filament\Resources\BookbindingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookbindingType extends EditRecord
{
    protected static string $resource = BookbindingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
