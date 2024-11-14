<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum InvoiceType: int implements HasLabel
{
	case Boleta = 3;
	case Factura = 1;

	public function getLabel(): ?string
	{
		return $this->name;
	}
}
