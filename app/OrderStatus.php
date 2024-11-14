<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: int implements HasLabel, HasColor, HasIcon
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

	public function getColor(): string|array|null
	{
		return match ($this)
		{
			self::Created => 'gray',
			self::Delivered => 'success',
			self::Cancelled => 'warning',
			default => 'info',
		};
	}

	public function getIcon(): ?string
	{
		return match ($this)
		{
			self::Created => 'heroicon-o-arrow-path',
			self::Confirmed => 'heroicon-o-shopping-bag',
			self::Delivering => 'heroicon-o-truck',
			self::Delivered => 'heroicon-o-gift',
			self::Cancelled => 'heroicon-o-x-mark',
		};
	}
}
