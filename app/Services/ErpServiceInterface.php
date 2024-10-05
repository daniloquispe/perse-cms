<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

interface ErpServiceInterface
{
	public function ping(): JsonResponse;
	public function products(): JsonResponse;
	public function product(int $id): JsonResponse;
}
