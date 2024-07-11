<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SagaResource\Pages;
use App\Filament\Resources\SagaResource\RelationManagers;
use App\Models\Saga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SagaResource extends Resource
{
    protected static ?string $model = Saga::class;

	protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

	protected static ?string $navigationGroup = 'Catálogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\TextInput::make('name')
					->label('Nombre')
					->required()
					->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->withCount('books')->orderBy('name'))
            ->columns([
				Tables\Columns\TextColumn::make('name')
					->label('Nombre')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('books_count')
					->label('Libros'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSagas::route('/'),
            'create' => Pages\CreateSaga::route('/create'),
            'edit' => Pages\EditSaga::route('/{record}/edit'),
        ];
    }
}
