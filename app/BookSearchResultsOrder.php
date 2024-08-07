<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum BookSearchResultsOrder: int implements HasLabel
{
	case ByRelevance = 1;
	case Latest = 2;
	case ByPriceAscending = 3;
	case ByPriceDescending = 4;
	case ByTitleAscending = 5;
	case ByTitleDescending = 6;

	public function getLabel(): ?string
	{
		return match ($this->value)
		{
			1 => 'Relevancia',
			2 => 'Más recientes',
			3 => 'Precio más alto',
			4 => 'Precio más bajo',
			5 => 'Nombre, creciente',
			6 => 'Nombre, decreciente',
			default => null,
		};
	}
}
