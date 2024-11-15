<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookCategoryResource\Pages;
use App\Filament\Resources\BookCategoryResource\RelationManagers;
use App\HasSeoTagsFormFields;
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
	use HasSeoTagsFormFields;

    protected static ?string $model = BookCategory::class;

	protected static ?string $navigationIcon = 'heroicon-o-tag';

	protected static ?string $modelLabel = 'Categoría';

	protected static ?string $navigationGroup = 'Catálogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				// Visible?
				Forms\Components\Toggle::make('is_visible')
					->label('Visible en el sitio web')
					->columnSpanFull(),
				// Basic info
				Forms\Components\Section::make('Información básica')
					->columns()
					->schema([
						Forms\Components\TextInput::make('name')
							->label('Nombre')
							->required()
							->live(true)
							->afterStateUpdated(function (string $operation, string $state, Forms\Set $set)
							{
								return $operation == 'create'
									? $set('seoTags.slug', Str::slug($state))
									: null;
							}),
						Forms\Components\TextInput::make('menu_title')
							->label('Título en el menú desplegable')
							->helperText('Deja este campo en blanco para usar el nombre de la categoría como título'),
						Forms\Components\TextInput::make('search_results_label')
							->label('Etiqueta para los resultados de búsqueda')
							->helperText('Deja este campo en blanco para que el mensaje sea "Se ha encontrado X libros"')
							->prefix('Se ha encontrado X'),
					]),
				// SEO
				self::getFormSectionWithSeoTags(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->orderBy('name')->withCount('books'))
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
