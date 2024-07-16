<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookAgeRangeResource\Pages;
use App\Filament\Resources\BookAgeRangeResource\RelationManagers;
use App\Models\BookAgeRange;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookAgeRangeResource extends Resource
{
    protected static ?string $model = BookAgeRange::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Catálogo';

	protected static ?string $modelLabel = 'Rango de edad';

	protected static ?string $pluralModelLabel = 'Rangos de edad';

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
            'index' => Pages\ListBookAgeRanges::route('/'),
            'create' => Pages\CreateBookAgeRange::route('/create'),
            'edit' => Pages\EditBookAgeRange::route('/{record}/edit'),
        ];
    }
}
