<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

	protected static ?string $title = 'Ítems del pedido';

    /*public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('book')
                    ->required()
                    ->maxLength(255),
            ]);
    }*/

    public function table(Table $table): Table
    {
        return $table
			->recordTitle(fn(OrderItem $record) => $record->book->title)
            ->columns([
				Tables\Columns\ImageColumn::make('book.cover')
					->label('Portada'),
                Tables\Columns\TextColumn::make('book.title')
					->label('Título')
					->description(fn(OrderItem $record) => "SKU: {$record->book->sku}"),
				Tables\Columns\TextColumn::make('quantity')
					->label('Cantidad')
					->numeric()
					->summarize(Tables\Columns\Summarizers\Sum::make()->label('Total de libros')),
				Tables\Columns\TextColumn::make('subtotal')
					->money('PEN')
					->summarize([
						Tables\Columns\Summarizers\Summarizer::make()
							->label('Envío')
							->using(fn() => $this->getOwnerRecord()->delivery_price)
							->money('PEN'),
						Tables\Columns\Summarizers\Summarizer::make()
							->label('Total')
							->using(fn() => $this->getOwnerRecord()->total)
							->money('PEN'),
					]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                /*Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
            ]);
    }
}
