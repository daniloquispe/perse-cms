<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Filament\Resources\SocialLinkResource\RelationManagers;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Contenidos';

	protected static ?string $modelLabel = 'Red social';

	protected static ?string $pluralModelLabel = 'Redes sociales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Toggle::make('is_visible')
					->label('¿Visible?')
					->default(true)
					->columnSpanFull(),
				Forms\Components\Group::make([
					Forms\Components\TextInput::make('name')
						->label('Nombre')
						->required()
						->maxLength(50),
					Forms\Components\TextInput::make('url')
						->label('URL')
						->url()
						->required()
						->maxLength(255),
					Forms\Components\TextInput::make('order')
						->label('Orden')
						->numeric()
						->default(0),
				]),
				Forms\Components\Group::make([
					Forms\Components\Textarea::make('svg')
						->label('Código SVG del ícono')
						->required(),
				]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\TextColumn::make('order')
					->label('Orden'),
				Tables\Columns\TextColumn::make('name')
					->label('Nombre'),
				Tables\Columns\TextColumn::make('url')
					->label('URL'),
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
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
