<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?string $modelLabel = 'Cliente';

	protected static ?string $navigationGroup = 'Tienda';

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
			->modifyQueryUsing(fn(Builder $query) => $query/*->where('is_customer', true)*/->latest())
            ->columns([
				Tables\Columns\TextColumn::make('name')
					->label('Nombre'),
				Tables\Columns\TextColumn::make('created_at')
					->label('Registro')
					->date(),
				Tables\Columns\IconColumn::make('email_verified_at')
					->label('¿Verificado?')
					->boolean(fn($record) => $record->email_verified_at != null),
            ])
            ->filters([
                //
            ])
            ->actions([
				Tables\Actions\Action::make('Activar')
					->icon('heroicon-o-check')
					->disabled(fn(Customer $record) => $record->email_verified_at != null)
					->action(function (Customer $record)
					{
						$record->email_verified_at = now();
						return $record->save();
					}),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
