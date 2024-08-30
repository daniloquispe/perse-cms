<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\CommentStatus;
use App\Filament\Resources\CommentResource;
use App\Models\Comment;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;

class ViewComment extends ViewRecord
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
			Actions\Action::make('approve')
				->label('Aprobar')
				->requiresConfirmation()
				->color(Color::Green)
				->action(function (Comment $record)
				{
					if ($record->update(['status' => CommentStatus::Approved]))
						Notification::make()
							->title('Aprobado')
							->success()
							->send();
					else
						Notification::make()
							->title('No se pudo aprobar')
							->body('Por favor, inténtalo nuevamente')
							->warning()
							->send();
				}),
			Actions\Action::make('reject')
				->label('Rechazar')
				->requiresConfirmation()
				->color(Color::Red)
				->action(function (Comment $record)
				{
					if ($record->update(['status' => CommentStatus::Rejected]))
						Notification::make()
							->title('Rechazado')
							->danger()
							->send();
					else
						Notification::make()
							->title('No se pudo rechazar')
							->body('Por favor, inténtalo nuevamente')
							->warning()
							->send();
				}),
//            Actions\DeleteAction::make(),
        ];
    }
}
