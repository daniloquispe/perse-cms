<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

	protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

	protected static ?string $modelLabel = 'Autor';

	protected static ?string $pluralModelLabel = 'Autores';

	protected static ?string $navigationGroup = 'Catálogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\Section::make('Información del autor')
					->columns()
					->schema([
						Forms\Components\TextInput::make('name')
							->label('Nombre')
							->required(),
						Forms\Components\FileUpload::make('photo')
							->label('Foto')
							->image()
							->directory('authors'),
						Forms\Components\MarkdownEditor::make('summary')
							->label('Reseña')
							->columnSpanFull(),
					]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->withCount('books')->orderBy('name'))
            ->columns([
				Tables\Columns\ImageColumn::make('photo')
					->label('Foto')
					->alignCenter(),
				Tables\Columns\TextColumn::make('name')
					->label('Nombre')
					->searchable()
					->sortable(),
				Tables\Columns\TextColumn::make('books_count')
					->label('Libros')
					->sortable(),
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
