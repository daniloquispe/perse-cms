<?php

namespace App;

enum PageRole: int
{
	case Home = 1;
	case Contact = 2;
	case AboutUs = 3;
	case ComplaintsBook = 4;
	case PrivacyPolitics = 5;
	case CookiesPolitics = 6;
	case DeliveryPolitics = 7;
	case ReturningPolitics = 8;
	case Terms = 9;
}
