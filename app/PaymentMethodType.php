<?php

namespace App;

enum PaymentMethodType: int
{
	case CreditOrDebitCard = 1;

	case QrCode = 2;

	case PagoEfectivo = 3;
}
