<?php

namespace App\Filament\Resources\BookCarouselResource\RelationManagers;

use App\Models\Book;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';

	protected static ?string $title = 'Libros';

	private static function pivotFormSchema(): array
	{
		return [
			Forms\Components\TextInput::make('order')
				->label('Orden')
				->numeric()
				->default(0)
				->required(),
			Forms\Components\Toggle::make('can_be_visible')
				->label('Puede ser visible en el carrusel')
				->helperText('El libro debe también estar marcado como visible para que se vea en el carrusel')
				->default(true),
		];
	}

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
			->modifyQueryUsing(fn(Builder $query) => $query->with('bookCarousels')->orderBy('pivot_order'))
            ->columns([
				Tables\Columns\TextColumn::make('pivot.order')
					->label('Orden')
					->numeric()
					->sortable(),
				Tables\Columns\ImageColumn::make('cover')
					->label('Cubierta')
					->alignCenter(),
                Tables\Columns\TextColumn::make('title')
					->label('Libro')
					->description(fn(Book $record) => $record->authors->pluck('name')->join(', '))
					->sortable()
					->searchable(),
				Tables\Columns\ToggleColumn::make('pivot.can_be_visible')
					->label('¿Puede ser visible?')
					->alignCenter()
            ])
            ->filters([
                //
            ])
            ->headerActions([
				Tables\Actions\AttachAction::make()
					->form(fn(Tables\Actions\AttachAction $action) => array_merge([$action->getRecordSelect()], self::pivotFormSchema())),
            ])
            ->actions([
				Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
