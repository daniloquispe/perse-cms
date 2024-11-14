<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UbigeoService
{
	/**
	 * Load a list of Peru departments.
	 *
	 * @return array<int, string>
	 */
	public function loadDepartments(): array
	{
		$response = Http::get('https://adminisol.isolperu.com/api/departments');
		$responseBody = $response->body();

		return json_decode($responseBody, true);
	}

	/**
	 * Load a list of Peru provinces for a certain department.
	 *
	 * @return array<int, string>
	 */
	public function loadProvinces(int $departmentId): array
	{
		$response = Http::get('https://adminisol.isolperu.com/api/provinces/' . $departmentId);
		$responseBody = $response->body();

		return json_decode($responseBody, true);
	}

	/**
	 * Load a list of Peru districts for a certain province.
	 *
	 * @return array<int, string>
	 */
	public function loadDistricts(int $provinceId): array
	{
		$response = Http::get('https://adminisol.isolperu.com/api/districts/' . $provinceId);
		$responseBody = $response->body();

		return json_decode($responseBody, true);
	}

	/**
	 * Get a department info.
	 *
	 * @return array{
	 *     id: int,
	 *     name: string
	 * }
	 */
	public function getDepartment(int $id): array
	{
		$response = Http::get("https://adminisol.isolperu.com/api/department/$id");
		$responseBody = $response->body();

		return json_decode($responseBody, true);
	}

	/**
	 * Get a province info.
	 *
	 * @return array{
	 *     id: int,
	 *     name: string
	 * }
	 */
	public function getProvince(int $id): array
	{
		$response = Http::get("https://adminisol.isolperu.com/api/province/$id");
		$responseBody = $response->body();

		return json_decode($responseBody, true);
	}

	/**
	 * Get a district info.
	 *
	 * @return array{
	 *     id: int,
	 *     name: string
	 * }
	 */
	public function getDistrict(int $id): array
	{
		$response = Http::get("https://adminisol.isolperu.com/api/district/$id");
		$responseBody = $response->body();

		return json_decode($responseBody, true);
	}
}
