<?php

namespace App\Filament\Resources\SliderResource\RelationManagers;

use App\Models\Slide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlidesRelationManager extends RelationManager
{
	protected static string $relationship = 'slides';

	public function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Group::make([
					Forms\Components\Toggle::make('is_enabled')
						->label('Visible en el sitio web')
						->default(true),
					Forms\Components\FileUpload::make('image')
						->label('Imagen del slide')
						->image()
						->required()
						->directory('slides'),
				]),
				Forms\Components\Group::make([
					Forms\Components\TextInput::make('order')
						->label('Orden')
						->numeric(),
					Forms\Components\TextInput::make('name')
						->label('Nombre')
						->helperText('Se usará como texto alternativo para la imagen del slide')
						->required()
						->maxLength(255),
					Forms\Components\TextInput::make('url')
						->label('URL')
						->helperText('Se abrirá esta URL al pulsar sobre la imagen')
						->url(),
				]),
			]);
	}

	public function table(Table $table): Table
	{
		return $table
			->recordTitleAttribute('name')
			->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
			->columns([
				Tables\Columns\TextColumn::make('order')
					->label('Orden'),
				Tables\Columns\ImageColumn::make('image')
					->label('Imagen'),
				Tables\Columns\TextColumn::make('name')
					->label('Nombre')
					->weight(FontWeight::Bold)
					->searchable(),
				Tables\Columns\IconColumn::make('is_enabled')
					->label('¿Visible?')
					->boolean(),
			])
			->filters([
				//
			])
			->headerActions([
				Tables\Actions\CreateAction::make(),
			])
			->actions([
				Tables\Actions\Action::make('link')
					->icon('heroicon-o-link')
					->url(fn(Slide $record) => $record->url, true)
					->disabled(fn(Slide $record) => $record->url == ''),
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}
}
