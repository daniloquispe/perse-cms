<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\HasSeoTagsFormFields;
use App\Models\Book;
use App\Models\BookCategory;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BookResource extends Resource
{
	use HasSeoTagsFormFields;

    protected static ?string $model = Book::class;

	protected static ?string $navigationIcon = 'heroicon-o-book-open';

	protected static ?string $modelLabel = 'Libro';

	protected static ?string $navigationGroup = 'Catálogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				// Visible?
				Forms\Components\Toggle::make('is_visible')
					->label('Visible en el sitio web'),
				// Basic info
				Forms\Components\Section::make('Información básica')
					->columns()
					->schema([
						Forms\Components\TextInput::make('relevance')
							->label('Relevancia')
							->helperText('Los libros con mayor relevancia aparecerán primero en las listas ordenadas por relevancia')
							->numeric()
							->default(0)
							->minValue(0)
							->maxValue(20)
							->required(),
						Forms\Components\TextInput::make('title')
							->label('Título')
							->required()
							->live(true)
							->afterStateUpdated(function (string $operation, string $state, Forms\Set $set)
							{
								return $operation == 'create'
									? $set('seoTags.slug', Str::slug($state))
									: null;
							}),
						Forms\Components\TextInput::make('year')
							->label('Año')
							->numeric()
							->default(date('Y')),
						Forms\Components\Select::make('authors')
							->label('Autor(es)')
							->multiple()
							->relationship('authors', 'name')
							->searchable(),
						Forms\Components\FileUpload::make('cover')
							->label('Foto de la cubierta')
							->image()
							->imageEditor()
							->directory('books'),
						Forms\Components\RichEditor::make('summary')
							->label('Reseña'),
					]),
				// Dimensions
				Forms\Components\Section::make('Dimensiones')
					->columns(4)
					->schema([
						Forms\Components\TextInput::make('width')
							->label('Ancho')
							->numeric()
							->suffix('cm'),
						Forms\Components\TextInput::make('height')
							->label('Altura')
							->numeric()
							->suffix('cm'),
						Forms\Components\TextInput::make('weight')
							->label('Peso')
							->numeric()
							->suffix('kg'),
						Forms\Components\TextInput::make('pages_count')
							->label('# páginas')
							->numeric(),
					]),
				// Classification
				Forms\Components\Section::make('Clasificación')
					->columns()
					->schema([
						Forms\Components\TextInput::make('sku')
							->label('SKU')
							->required(),
						Forms\Components\TextInput::make('isbn')
							->label('ISBN')
							->minLength(10)
							->maxLength(13),
						SelectTree::make('category_id')
							->label('Categoría')
							->relationship('category', 'name', 'parent_id')
							->searchable(),
						Forms\Components\Select::make('saga_id')
							->relationship('saga', 'name')
							->placeholder('Ninguna'),
						Forms\Components\Select::make('publisher_id')
							->label('Editorial')
							->relationship('publisher', 'name'),
						Forms\Components\Select::make('book_format_id')
							->label('Formato')
							->relationship('bookFormat', 'name', fn(Builder $query) => $query->orderBy('order'))
							->required(),
						Forms\Components\Select::make('bookbinding_type_id')
							->label('Tipo de encuadernación')
							->relationship('bookbindingType', 'name', fn(Builder $query) => $query->orderBy('order'))
							->required(),
						Forms\Components\Select::make('age_range_id')
							->label('Rango de edad')
							->relationship('ageRange', 'name')
							->required(),
					]),
				// Purchasing conditions
				Forms\Components\Section::make('Condiciones de venta')
					->columns(4)
					->schema([
						Forms\Components\TextInput::make('price')
							->label('Precio de venta')
							->prefix('S/')
							->required()
							->numeric(),
						Forms\Components\TextInput::make('discounted_price')
							->label('Precio de venta (con descuento)')
							->prefix('S/')
							->numeric(),
						Forms\Components\DatePicker::make('discount_from')
							->label('Inicio del descuento'),
						Forms\Components\DatePicker::make('discount_to')
							->label('Fin del descuento'),
						Forms\Components\Fieldset::make('Etiquetas')
							->columns(3)
							->schema([
								Forms\Components\Toggle::make('is_presale')
									->label('En preventa'),
								Forms\Components\Toggle::make('is_award_winning')
									->label('Libro premiado'),
								Forms\Components\Toggle::make('is_recommended')
									->label('Recomendado'),
							]),
					]),
				self::getFormSectionWithSeoTags(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->with('authors')->orderBy('title')->orderBy('year'))
            ->columns([
				Tables\Columns\ImageColumn::make('cover')
					->label('Cubierta')
					->alignCenter(),
				Tables\Columns\TextColumn::make('sku')
					->label('SKU')
					->searchable(),
				Tables\Columns\TextColumn::make('isbn')
					->label('ISBN')
					->searchable(),
				Tables\Columns\TextColumn::make('title')
					->label('Título')
					->description(fn(Book $record) => join(', ', $record->authors->pluck('name')->toArray()))
					->sortable()
					->searchable(),
				Tables\Columns\IconColumn::make('is_presale')
					->label('¿Preventa?')
					->boolean()
					->alignCenter(),
				Tables\Columns\ToggleColumn::make('is_visible')
					->label('¿Visible?')
					->alignCenter(),
            ])
            ->filters([
				Tables\Filters\Filter::make('tree')
					->form([
						SelectTree::make('categories')
							->label('Categoría')
							->relationship('category', 'name', 'parent_id')
							->independent(false)
							->enableBranchNode(),
					])
					->query(function (Builder $query, array $data)
					{
						return $query->when($data['categories'], function ($query, $categories)
						{
							return $query->whereHas('category', fn($query) => $query->where('id', $categories));
						});
					})
					->indicateUsing(function (array $data)
					{
						if (!$data['categories'])
							return null;

						return 'Categoría: ' . implode(', ', BookCategory::whereKey($data['categories'])->get()->pluck('name')->toArray());
					}),
				Tables\Filters\SelectFilter::make('author')
					->label('Autor')
					->relationship('authors', 'name')
					->searchable()
					->preload(),
				Tables\Filters\SelectFilter::make('publisher')
					->name('Editorial')
					->relationship('publisher', 'name'),
				Tables\Filters\SelectFilter::make('saga')
					->relationship('saga', 'name'),
				Tables\Filters\SelectFilter::make('book_format_id')
					->label('Formato')
					->relationship('bookFormat', 'name'),
				Tables\Filters\Filter::make('is_presale')
					->label('En preventa')
					->query(fn(Builder $query) => $query->where('is_presale', true)),
				Tables\Filters\Filter::make('is_award_winning')
					->label('Libros premiados')
					->query(fn(Builder $query) => $query->where('is_award_winning', true)),
				Tables\Filters\Filter::make('is_recommended')
					->label('Recomendados')
					->query(fn(Builder $query) => $query->where('is_recommended', true)),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
