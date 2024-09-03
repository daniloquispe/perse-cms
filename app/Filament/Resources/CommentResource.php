<?php

namespace App\Filament\Resources;

use App\CommentStatus;
use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $navigationGroup = 'Tienda';

	protected static ?string $modelLabel = 'Comentario';

	public static function getNavigationBadge(): ?string
	{
		return static::getModel()::where('status', CommentStatus::Pending)->count();
	}

	public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Forms\Components\TextInput::make('rate')
					->label('Calificación')
					->prefixIcon('heroicon-o-star')
					->prefixIconColor(Color::Yellow),
				Forms\Components\DateTimePicker::make('created_at')
					->label('Fecha y hora'),
				Forms\Components\TextInput::make('name')
					->label('Nombre'),
				Forms\Components\TextInput::make('email')
					->label('Correo electrónico')
					->email(),
				Forms\Components\Textarea::make('comment')
					->label('Comentario')
					->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\TextColumn::make('created_at')
					->label('Fecha y hora')
					->dateTime()
					->sortable(),
				Tables\Columns\TextColumn::make('rate')
					->label('Calificación')
					->badge()
					->icon('heroicon-o-star')
					->color(Color::Yellow)
					->sortable(),
				Tables\Columns\TextColumn::make('name')
					->label('Autor')
					->description(fn(Comment $record) => $record->author->full_name)
					->searchable()
					->sortable(),
				Tables\Columns\TextColumn::make('book.title')
					->label('Libro')
//					->description(fn(Comment $record) => $record->book->title)
					->searchable()
					->sortable(),
				Tables\Columns\TextColumn::make('status')
					->label('Estado')
					->badge()
					->searchable()
					->sortable(),
            ])
            ->filters([
				Tables\Filters\SelectFilter::make('book')
					->label('Libro')
					->relationship('book', 'title')
					->searchable(),
				/*Tables\Filters\SelectFilter::make('author')
					->label('Autor')
					->relationship('author', 'full_name')
					->searchable(),*/
            ])
            ->actions([
				Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListComments::route('/'),
//            'create' => Pages\CreateComment::route('/create'),
//            'edit' => Pages\EditComment::route('/{record}/edit'),
			'view' => Pages\ViewComment::route('/{record}'),
        ];
    }
}
