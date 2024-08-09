<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Gender;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'phone',
		'birthdate',
		'id_document_number',
		'gender',
		'is_subscribed',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'birthdate' => 'date',
			'email_verified_at' => 'datetime',
			'gender' => Gender::class,
			'password' => 'hashed',
		];
	}

	public function fullName(): Attribute
	{
		return Attribute::make(function ()
		{
			return $this->first_name || $this->last_name
				? trim($this->first_name . ' ' . $this->last_name)
				: null;
		});
	}
}
