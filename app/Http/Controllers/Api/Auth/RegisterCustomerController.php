<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RegisterCustomerController extends Controller
{
	public function __invoke(RegisterCustomerRequest $request): JsonResponse
	{
		$newCustomer = new User($request->validated());
		$newCustomer->name = '';
		$newCustomer->is_customer = true;

		if ($newCustomer->save())
			return Response::json(['message' => 'User registered']);

		return Response::json(['error' => 'User cannot be registered'], 500);
	}
}
