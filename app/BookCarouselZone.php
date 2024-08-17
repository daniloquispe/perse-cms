<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum BookCarouselZone: int implements HasLabel
{
	case Home1 = 1;
	case Home2 = 2;
	case Product = 3;

	public function getLabel(): ?string
	{
		return match ($this)
		{
			self::Home1 => 'Inicio (arriba)',
			self::Home2 => 'Inicio (abajo)',
			self::Product => 'Página de producto',
		};
	}
}
