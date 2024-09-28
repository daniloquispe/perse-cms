<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintSheet extends Model
{
	protected $fillable = [
		'name',
		'id_document_number',
		'address',
		'email',
		'phone',
		'is_service',
		'amount',
		'detail',
		'request',
		'reply',
	];
}
