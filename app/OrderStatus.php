<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum OrderStatus: int implements HasLabel
{
//	case InCart = 0;

	case Created = 1;

	case Confirmed = 2;

	case Delivering = 3;

	case Delivered = 4;

	case Cancelled = -1;

	public function getLabel(): ?string
	{
		return match ($this)
		{
			self::Created => 'Recibido',
			self::Confirmed => 'Confirmado',
			self::Delivering => 'En camino',
			self::Delivered => 'Entregado',
			self::Cancelled => 'Cancelado',
		};
	}
}
