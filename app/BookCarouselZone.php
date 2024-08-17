<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum BookCarouselZone: int implements HasLabel
{
	case HomeAbove = 1;
	case HomeBelow = 2;
	case Product = 3;

	public function getLabel(): ?string
	{
		return match ($this)
		{
			self::HomeAbove => 'Inicio (arriba)',
			self::HomeBelow => 'Inicio (abajo)',
			self::Product => 'Página de producto',
		};
	}
}
