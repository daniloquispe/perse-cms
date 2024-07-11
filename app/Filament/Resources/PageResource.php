<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\PageRole;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

	protected static ?string $navigationIcon = 'heroicon-o-document';

	protected static ?string $modelLabel = 'Página de información';

	protected static ?string $pluralModelLabel = 'Páginas de información';

	protected static ?string $navigationGroup = 'Contenidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Toggle::make('is_visible')
					->label('¿Visible?'),
				Forms\Components\Section::make('Información básica')
					->columns()
					->schema([
						Forms\Components\TextInput::make('name')
							->label('Nombre'),
						Forms\Components\FileUpload::make('image')
							->label('Imagen destacada')
							->helperText('Esta imagen aparecerá al compartir la página en redes sociales')
							->image()
							->directory('pages'),
						Forms\Components\RichEditor::make('content')
							->label('Contenido')
							->disabled(fn(Page $page) => !$page->can_have_content)
							->columnSpanFull(),
					]),
				Forms\Components\Section::make('Información para SEO')
					->columns()
					->schema([
						Forms\Components\TextInput::make('slug')
							->disabled(fn(Page $page) => !$page->can_have_slug),
						Forms\Components\TextInput::make('title')
							->label('Título de la página')
							->helperText('Aparece en la pestaña del navegador web'),
						Forms\Components\TextInput::make('description')
							->label('Descripción'),
					]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\TextColumn::make('name')
					->label('Nombre')
					->sortable()
					->searchable(),
				Tables\Columns\ToggleColumn::make('is_visible')
					->label('¿Visible?'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
