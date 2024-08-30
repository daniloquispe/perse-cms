<?php

namespace App;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CommentStatus: string implements HasLabel, HasColor, HasIcon
{
	case Pending = 'P';
	case Approved = 'A';
	case Rejected = 'R';

	public function getLabel(): ?string
	{
		return match ($this)
		{
			self::Pending => 'Pendiente',
			self::Approved => 'Aprobado',
			self::Rejected => 'Rechazado',
		};
	}

	public function getColor(): string|array|null
	{
		return match ($this)
		{
			self::Pending => Color::Amber,
			self::Approved => Color::Green,
			self::Rejected => Color::Red,
		};
	}

	public function getIcon(): ?string
	{
		return match ($this)
		{
			self::Pending => null,
			self::Approved => 'heroicon-o-check',
			self::Rejected => 'heroicon-o-x-mark',
		};
	}
}
