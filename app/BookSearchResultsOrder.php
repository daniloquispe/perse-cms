<?php

namespace App;

enum BookSearchResultsOrder: int
{
	case ByRelevance = 1;
	case Latest = 2;
	case ByPriceAscending = 3;
	case ByPriceDescending = 4;
	case ByTitleAscending = 5;
	case ByTitleDescending = 6;
}
