<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookCategoryResource\Pages;
use App\Filament\Resources\BookCategoryResource\RelationManagers;
use App\Models\BookCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BookCategoryResource extends Resource
{
    protected static ?string $model = BookCategory::class;

	protected static ?string $navigationIcon = 'heroicon-o-tag';

	protected static ?string $modelLabel = 'Categoría';

	protected static ?string $navigationGroup = 'Catálogo';

    public static function form(Form $form): Form
    {
        return $form
			->columns(3)
            ->schema([
				Forms\Components\Toggle::make('is_visible')
					->label('Visible en el sitio web')
					->columnSpanFull(),
				Forms\Components\TextInput::make('order')
					->label('Orden')
					->numeric(),
				Forms\Components\TextInput::make('name')
					->label('Nombre')
					->required()
					->live(true)
					->afterStateUpdated(function (string $operation, string $state, Forms\Set $set)
					{
						return $operation == 'create'
							? $set('slug', Str::slug($state))
							: null;
					}),
				Forms\Components\TextInput::make('slug')
					->label('Slug')
					->required()
					->unique(BookCategory::class, 'slug', ignoreRecord: true)
					->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->whereNull('parent_id')->withCount('books'))
            ->columns([
				Tables\Columns\TextColumn::make('name')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('books_count')
					->label('Libros'),
				Tables\Columns\ToggleColumn::make('is_visible')
					->label('¿Visible?'),
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
            'index' => Pages\ListBookCategories::route('/'),
            'create' => Pages\CreateBookCategory::route('/create'),
            'edit' => Pages\EditBookCategory::route('/{record}/edit'),
        ];
    }
}
