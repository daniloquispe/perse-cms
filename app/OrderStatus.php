<?php

namespace App;

enum OrderStatus: int
{
	case InCart = 0;

	case Created = 1;

	case Accepted = 2;

	case Delivering = 3;

	case Delivered = 4;

	case Rejected = -1;
}
