<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Customer;
use App\Models\Order;
use App\OrderStatus;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

	protected static ?string $modelLabel = 'Pedido';

	protected static ?string $navigationGroup = 'E-commerce';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->with(['customer', 'items'])->latest())
            ->columns([
				Tables\Columns\TextColumn::make('created_at')
					->label('Fecha de compra')
					->date(),
				Tables\Columns\TextColumn::make('customer.full_name')
					->label('Cliente'),
				Tables\Columns\TextColumn::make('delivery_date')
					->label('Fecha de entrega')
					->date()
					->description(fn(Order $record) => $record->delivery_date->diffForHumans()),
				Tables\Columns\TextColumn::make('total')
					->label('Total')
					->money('PEN'),
				Tables\Columns\TextColumn::make('status')
					->label('Estado')
					->badge(),
            ])
            ->filters([
				// By creation date
				Tables\Filters\Filter::make('created_at')
					->form([Forms\Components\DatePicker::make('created_at')])
					->indicateUsing(fn(array $data) => $data['created_at'] ? 'Creado: ' . Carbon::parse($data['created_at'])->toFormattedDateString() : null)
					->query(function (Builder $query, array $data)
					{
						$query->when($data['created_at'], fn(Builder $query, $date) => $query->whereDate('created_at', $date));
					}),
				// By customer
				Tables\Filters\Filter::make('customer_id')
					->form([
						Forms\Components\Select::make('customer_id')
							->label('Cliente')
							->relationship('customer')
							->getOptionLabelFromRecordUsing(fn(Customer $record) => $record->full_name)
							->searchable(['first_name', 'last_name'])
					]),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
			RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
//            'create' => Pages\CreateOrder::route('/create'),
//            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
