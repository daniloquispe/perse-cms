<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookbindingTypeResource\Pages;
use App\Filament\Resources\BookbindingTypeResource\RelationManagers;
use App\Models\BookbindingType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookbindingTypeResource extends Resource
{
    protected static ?string $model = BookbindingType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Catálogo';

	protected static ?string $modelLabel = 'Tipo de encuadernación';

	protected static ?string $pluralModelLabel = 'Tipos de encuadernación';

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
			->modifyQueryUsing(fn(Builder $query) => $query->orderBy('name')->withCount('books'))
            ->columns([
				Tables\Columns\TextColumn::make('name')
					->label('Nombre'),
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
            'index' => Pages\ListBookbindingTypes::route('/'),
            'create' => Pages\CreateBookbindingType::route('/create'),
            'edit' => Pages\EditBookbindingType::route('/{record}/edit'),
        ];
    }
}
