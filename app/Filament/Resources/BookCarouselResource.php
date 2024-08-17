<?php

namespace App\Filament\Resources;

use App\BookCarouselZone;
use App\Filament\Resources\BookCarouselResource\Pages;
use App\Filament\Resources\BookCarouselResource\RelationManagers;
use App\Models\BookCarousel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookCarouselResource extends Resource
{
    protected static ?string $model = BookCarousel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Contenidos';

	protected static ?string $modelLabel = 'Carrusel de libros';

	protected static ?string $pluralModelLabel = 'Carruseles de libros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Toggle::make('is_visible')
					->label('Visible en el sitio web')
					->default(true)
					->columnSpanFull(),
				Forms\Components\Group::make([
					Forms\Components\Section::make('Información básica')
						->schema([
							Forms\Components\TextInput::make('order')
								->label('Orden')
								->numeric()
								->default(0)
								->required(),
							Forms\Components\TextInput::make('title')
								->label('Título')
								->required()
								->unique(ignoreRecord: true)
								->maxLength(50)
						]),
				]),
				Forms\Components\Group::make([
					Forms\Components\Section::make('Dónde mostrar el carrusel')
						->schema([
							Forms\Components\Select::make('zone')
								->label('Mostrar en')
								->options(BookCarouselZone::class)
								->required()
								->live(),
							Forms\Components\Select::make('book_id')
								->label('Producto')
								->relationship('book', 'name')
								->searchable()
								->hidden(fn(Forms\Get $get) => $get('zone') != BookCarouselZone::Product->value)
								->required(fn(Forms\Get $get) => $get('zone') == BookCarouselZone::Product->value),
						]),
				]),
			]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->with(['book', 'books'])->orderBy('order'))
            ->columns([
				Tables\Columns\TextColumn::make('order')
					->label('Orden')
					->numeric()
					->sortable(),
				Tables\Columns\ImageColumn::make('books.cover')
					->stacked()
					->limit()
					->limitedRemainingText(),
				Tables\Columns\TextColumn::make('title')
					->label('Título')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('zone')
					->label('Mostrar en')
					->description(fn(BookCarousel $record) => $record->book?->title)
					->sortable(),
				Tables\Columns\ToggleColumn::make('is_visible')
					->label('¿Visible?')
					->alignCenter(),
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
			RelationManagers\BooksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookCarousels::route('/'),
            'create' => Pages\CreateBookCarousel::route('/create'),
            'edit' => Pages\EditBookCarousel::route('/{record}/edit'),
        ];
    }
}
