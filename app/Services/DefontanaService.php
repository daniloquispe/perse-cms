<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class DefontanaService implements ErpServiceInterface
{
	public function getOrderNumber(): string
	{
		return '12345';
	}

	public function ping(): JsonResponse
	{
		// TODO: Implement ping() method.
	}

	public function products(): JsonResponse
	{
		// TODO: Implement products() method.
	}

	public function product(int $id): JsonResponse
	{
		// TODO: Implement product() method.
	}
}
