<?php

namespace App\Filament\Resources\SagaResource\Pages;

use App\Filament\Resources\SagaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaga extends EditRecord
{
    protected static string $resource = SagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
