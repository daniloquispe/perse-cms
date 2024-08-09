<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasLabel
{
	case male = 'M';
	case female = 'F';
	case other = 'O';

	public function getLabel(): ?string
	{
		return match ($this->value)
		{
			'M' => 'Masculino',
			'F' => 'Femenino',
			'O' => 'Otro',
			default => null
		};
	}
}
