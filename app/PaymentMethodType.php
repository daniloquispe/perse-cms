<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethodType: int implements HasLabel
{
	case CreditOrDebitCard = 1;

	case QrCode = 2;

	case PagoEfectivo = 3;

	case BankTransfer = 4;

	public function getLabel(): ?string
	{
		return match ($this)
		{
			self::CreditOrDebitCard => 'Tarjeta de crédito o débito',
			self::QrCode => 'Código QR',
			self::PagoEfectivo => 'PagoEfectivo',
			self::BankTransfer => 'Transferencia bancaria',
		};
	}
}
