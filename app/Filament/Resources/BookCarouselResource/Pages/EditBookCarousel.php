<?php

namespace App\Filament\Resources\BookCarouselResource\Pages;

use App\Filament\Resources\BookCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookCarousel extends EditRecord
{
    protected static string $resource = BookCarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
