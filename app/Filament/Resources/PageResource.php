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
use Illuminate\Support\HtmlString;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

	protected static ?string $navigationIcon = 'heroicon-o-document';

	protected static ?string $modelLabel = 'Página de información';

	protected static ?string $pluralModelLabel = 'Páginas de información';

	protected static ?string $navigationGroup = 'Contenidos';

    public static function form(Form $form): Form
    {
		$colsCount = $form->getRecord()->has_title ? 3 : 2;

		return $form
            ->schema([
				// Visible?
				Forms\Components\Toggle::make('is_visible')
					->label('¿Visible?'),
				// Basic info
				Forms\Components\Section::make('Información básica')
					->description(fn(Page $page) => new HtmlString("Página: <strong>{$page->role->getLabel()}</strong>"))
					->columns($colsCount)
					->schema([
						Forms\Components\TextInput::make('name')
							->label('Nombre en menú')
							->required()
							->maxLength(50),
						Forms\Components\TextInput::make('title')
							->label('Título de la página')
							->hidden(fn(Page $page) => !$page->has_title)
							->required(fn(Page $page) => $page->has_title)
							->maxLength(150),
						Forms\Components\FileUpload::make('image')
							->label('Imagen destacada')
							->helperText('Esta imagen aparecerá al compartir la página en redes sociales')
							->image()
							->directory('pages'),
						Forms\Components\RichEditor::make('content')
							->label('Contenido')
							->hidden(fn(Page $page) => !$page->has_content)
							->columnSpanFull(),
					]),
				// SEO
				Forms\Components\Section::make('Información para SEO')
					->columns()
					->schema([
						Forms\Components\TextInput::make('slug')
							->hidden(fn(Page $page) => !$page->has_slug)
							->required(fn(Page $page) => $page->has_slug),
						Forms\Components\TextInput::make('meta_title')
							->label('Título en el navegador')
							->helperText('Aparece en la pestaña o ventana del navegador web')
							->maxLength(150),
						Forms\Components\TextInput::make('description')
							->label('Descripción')
							->maxLength(150),
					]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\TextColumn::make('role')
					->label('Página'),
				Tables\Columns\TextColumn::make('name')
					->label('Nombre en menú')
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
