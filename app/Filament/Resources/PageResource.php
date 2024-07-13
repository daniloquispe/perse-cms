<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\HasSeoTagsFormFields;
use App\Models\Page;
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
	use HasSeoTagsFormFields;

    protected static ?string $model = Page::class;

	protected static ?string $navigationIcon = 'heroicon-o-document';

	protected static ?string $modelLabel = 'Página de información';

	protected static ?string $pluralModelLabel = 'Páginas de información';

	protected static ?string $navigationGroup = 'Contenidos';

    public static function form(Form $form): Form
    {
		$page = $form->getRecord();  /* @var $page Page */

		$hasSlug = $page->has_slug;
		$hasContent = $page->has_content;
		$hasTitle = $page->has_title;

		$colsCount = $hasTitle ? 3 : 2;

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
							->hidden(!$hasTitle)
							->required($hasTitle)
							->maxLength(150),
						Forms\Components\FileUpload::make('image')
							->label('Imagen destacada')
							->helperText('Esta imagen aparecerá al compartir la página en redes sociales')
							->image()
							->directory('pages'),
						Forms\Components\RichEditor::make('content')
							->label('Contenido')
							->hidden(!$hasContent)
							->columnSpanFull(),
					]),
				// SEO
				self::getFormSectionWithSeoTags($hasSlug),
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
