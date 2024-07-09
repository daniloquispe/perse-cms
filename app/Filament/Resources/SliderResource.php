<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Contenidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Toggle::make('is_visible')
					->label('Visible en el sitio web'),
				Forms\Components\Section::make()
					->columns()
					->schema([
						Forms\Components\TextInput::make('name')
							->label('Nombre')
							->helperText('Solo para uso interno, no se mostrará en el sitio web')
							->required(),
						Forms\Components\TextInput::make('delay')
							->label('Duración de la transición')
							->suffix('ms')
							->default(3000)
							->numeric(),
					]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->with('slides:slider_id,image'))
            ->columns([
				Tables\Columns\ImageColumn::make('slides.image')
					->stacked()
					->limit()
					->limitedRemainingText(),
				Tables\Columns\TextColumn::make('name')
					->label('Nombre')
					->weight(FontWeight::Bold)
					->searchable(),
				Tables\Columns\ToggleColumn::make('is_visible')
					->label('¿Visible?')
					->beforeStateUpdated(function (Slider $record)
					{
						Slider::query()
							->whereKeyNot($record->id)
							->update(['is_visible' => false]);
					}),
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
			RelationManagers\SlidesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
