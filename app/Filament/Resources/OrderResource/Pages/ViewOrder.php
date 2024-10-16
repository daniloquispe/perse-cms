<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\InvoiceType;
use App\Models\Order;
use App\OrderStatus;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        $nextStepAction = match ($this->getRecord()->status)
		{
			OrderStatus::Created => Actions\Action::make('markAsConfirmed')
				->label('Marcar como ' . OrderStatus::Confirmed->getLabel())
				->icon(OrderStatus::Confirmed->getIcon())
				->successNotificationTitle('Pedido confirmado')
				->successRedirectUrl('orders.list')
				->failureNotification(Notification::make()
					->title('No se pudo confirmar el pedido')
					->body('Por favor, inténtalo nuevamente')
					->warning())
				->action(function (Order $record)
				{
					$record->confirmed_at = Carbon::now();
					$record->save();
				}),

			OrderStatus::Confirmed => Actions\Action::make('markAsDelivering')
				->label('Marcar como ' . OrderStatus::Delivering->getLabel())
				->icon(OrderStatus::Delivering->getIcon())
				->successNotificationTitle('Pedido en camino')
				->successRedirectUrl('orders.list')
				->failureNotification(Notification::make()
					->title('No se pudo actualizar el pedido')
					->body('Por favor, inténtalo nuevamente')
					->warning())
				->action(function (Order $record)
				{
					$record->delivering_at = Carbon::now();
					return $record->save();
				}),

			OrderStatus::Delivering => Actions\Action::make('markAsDelivered')
				->label('Marcar como ' . OrderStatus::Delivered->getLabel())
				->icon(OrderStatus::Delivered->getIcon())
				->successNotificationTitle('Pedido entregado')
				->successRedirectUrl('orders.list')
				->failureNotification(Notification::make()
					->title('No se pudo actualizar el pedido')
					->body('Por favor, inténtalo nuevamente')
					->warning())
				->action(function (Order $record)
				{
					$record->delivered_at = Carbon::now();
					return $record->save();
				}),

			default => null,
		};

		$backAction = Actions\Action::make('goBack')
			->label('Atrás')
			->url(route('filament.admin.resources.orders.index'))
			->outlined();

		return $nextStepAction
			? compact('nextStepAction', 'backAction')
			: compact('backAction');
    }

	public function infolist(Infolist $infolist): Infolist
	{
		return $infolist
			->schema([
				Section::make('Datos personales')
					->columns(3)
					->schema([
						TextEntry::make('customer.full_name')
							->label('Cliente'),
						TextEntry::make('email')
							->label('Correo electrónico'),
						TextEntry::make('phone')
							->label('Teléfono'),
						Fieldset::make('Comprobante de pago')
							->columns(3)
							->schema([
								TextEntry::make('invoice_type')
									->label('Tipo de comprobante'),
								TextEntry::make('ruc')
									->label('RUC')
									->visible(fn(Order $record) => $record->invoice_type == InvoiceType::Factura),
								TextEntry::make('business_name')
									->label('Razón social')
									->visible(fn(Order $record) => $record->invoice_type == InvoiceType::Factura),
							]),
					]),
				Section::make('Detalle de entrega')
					->schema([
						Fieldset::make('Dirección')
							->schema([
								Grid::make(3)
									->schema([
										TextEntry::make('department_name')
											->label('Departamento'),
										TextEntry::make('province_name')
											->label('Provincia'),
										TextEntry::make('district_name')
											->label('Distrito'),
									]),
								Grid::make(3)
									->schema([
										TextEntry::make('address')
											->label('Dirección'),
										TextEntry::make('location_number')
											->label('Número'),
										TextEntry::make('reference')
											->label('Referencia'),
									])
							]),
						Grid::make()
							->schema([
								TextEntry::make('recipient_name')
									->label('Persona que recibirá el pedido'),
								TextEntry::make('delivery_date')
									->label('Fecha de entrega')
									->helperText(fn(Order $record) => $record->delivery_date->diffForHumans())
									->date(),
							]),
					]),
				Section::make('Método de pago')
					->schema([
						TextEntry::make('payment_method_type')
							->label('Método de pago'),
					]),
			]);
	}
}
