<?php

namespace App\Filament\Resources\BookAgeRangeResource\Pages;

use App\Filament\Resources\BookAgeRangeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookAgeRange extends EditRecord
{
    protected static string $resource = BookAgeRangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
