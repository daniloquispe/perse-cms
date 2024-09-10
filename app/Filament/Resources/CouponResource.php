<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

	protected static ?string $navigationGroup = 'Tienda';

	protected static ?string $modelLabel = 'Cupón';

	protected static ?string $pluralModelLabel = 'Cupones';

    public static function form(Form $form): Form
    {
        return $form
			->columns()
            ->schema([
				Forms\Components\Toggle::make('is_enabled')
					->label('Cupón activo')
					->columnSpanFull(),
				Forms\Components\TextInput::make('code')
					->label('Código')
					->helperText('Es el que se ingresará en el carrito de compras')
					->required()
					->maxLength(20),
				Forms\Components\TextInput::make('name')
					->label('Nombre')
					->helperText('No se mostrará en el sitio web')
					->required(),
				Forms\Components\TextInput::make('discount_rate')
					->label('Descuento')
					->numeric()
					->suffix('%')
					->required()
					->minValue(0)
					->maxValue(100),
				Forms\Components\DatePicker::make('due_at')
					->label('Vencimiento')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\TextColumn::make('code')
					->label('Código')
					->searchable(),
				Tables\Columns\TextColumn::make('name')
					->label('Nombre')
					->searchable(),
				Tables\Columns\TextColumn::make('discount_rate')
					->label('Descuento')
					->numeric()
					->formatStateUsing(fn(Coupon $record) => $record->discount_rate . '%'),
				Tables\Columns\TextColumn::make('due_at')
					->label('Vencimiento')
					->date(),
				Tables\Columns\ToggleColumn::make('is_enabled')
					->label('¿Activo?'),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
