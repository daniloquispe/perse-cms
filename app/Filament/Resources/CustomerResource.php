<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Gender;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
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
				Forms\Components\TextInput::make('first_name')
					->label('Nombre')
					->required()
					->maxLength(100),
				Forms\Components\TextInput::make('last_name')
					->label('Apellido')
					->required()
					->maxLength(100),
				Forms\Components\TextInput::make('email')
					->label('E-mail')
					->email()
					->required()
					->maxLength(150),
				Forms\Components\TextInput::make('phone')
					->label('Teléfono')
					->tel()
					->maxLength(50),
				Forms\Components\DatePicker::make('birthdate')
					->label('Fecha de nacimiento')
					->maxDate(Carbon::today()),
				Forms\Components\TextInput::make('id_document_number')
					->label('Documento de identidad')
					->required()
					->maxLength(100),
				Forms\Components\Select::make('gender')
					->label('Género')
					->options(function ()
					{
						$options = [];

						foreach (Gender::cases() as $gender)
							$options[$gender->value] = $gender->getLabel();

						return $options;
					}),
				Forms\Components\Checkbox::make('is_subscribed')
					->label('Desea recibir promociones y novedades')
					->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->modifyQueryUsing(fn(Builder $query) => $query->latest())
            ->columns([
				Tables\Columns\TextColumn::make('full_name')
					->label('Nombre')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('email')
					->label('E-mail')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('created_at')
					->label('Registro')
					->date(),
				Tables\Columns\IconColumn::make('email_verified_at')
					->label('¿Verificado?')
					->boolean(fn($record) => $record->email_verified_at != null)
					->alignCenter(),
				Tables\Columns\IconColumn::make('is_subscribed')
					->label('¿Suscrito?')
					->boolean()
					->alignCenter(),
            ])
            ->filters([
				Tables\Filters\TernaryFilter::make('email_verified_at')
					->label('Verificados')
					->nullable(),
				Tables\Filters\TernaryFilter::make('is_subscribed')
					->label('Suscritos'),
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
