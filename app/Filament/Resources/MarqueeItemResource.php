<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarqueeItemResource\Pages;
use App\Filament\Resources\MarqueeItemResource\RelationManagers;
use App\Models\MarqueeItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarqueeItemResource extends Resource
{
    protected static ?string $model = MarqueeItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Contenidos';

	protected static ?string $modelLabel = 'Ítem de marquesina';

	protected static ?string $pluralModelLabel = 'Ítems de marquesina';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Toggle::make('is_visible')
					->label('¿Visible?')
					->default(true)
					->columnSpanFull(),
				Forms\Components\Split::make([
					Forms\Components\Section::make('Información básica')
						->schema([
							Forms\Components\TextInput::make('order')
								->label('Orden')
								->numeric()
								->required()
								->default(0),
							Forms\Components\TextInput::make('text')
								->label('Texto a mostrar')
								->required()
								->maxLength(150),
							Forms\Components\TextInput::make('url')
								->label('URL')
								->url()
								->maxLength(255),
						]),
					Forms\Components\Section::make('Colores')
						->schema([
							Forms\Components\ColorPicker::make('background_color')
								->label('Fondo'),
							Forms\Components\ColorPicker::make('text_color')
								->label('Texto'),
						]),
				])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->columns([
				Tables\Columns\TextColumn::make('order')
					->label('Orden')
					->sortable(),
				Tables\Columns\TextColumn::make('text')
					->label('Texto')
					->searchable()
					->sortable(),
				Tables\Columns\ColorColumn::make('background_color')
					->label('Color fondo')
					->alignCenter(),
				Tables\Columns\ColorColumn::make('text_color')
					->label('Color texto')
					->alignCenter(),
				Tables\Columns\ToggleColumn::make('is_visible')
					->label('¿Visible?')
					->alignCenter(),
            ])
            ->filters([
				Tables\Filters\Filter::make('is_visible')
					->label('Visibles')
					->query(fn(Builder $query) => $query->where('is_visible', true)),
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
            'index' => Pages\ListMarqueeItems::route('/'),
            'create' => Pages\CreateMarqueeItem::route('/create'),
            'edit' => Pages\EditMarqueeItem::route('/{record}/edit'),
        ];
    }
}
