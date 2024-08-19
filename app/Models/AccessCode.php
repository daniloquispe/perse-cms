<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
	protected $primaryKey = 'email';

	protected $keyType = 'string';

	protected $fillable = ['email', 'access_code'];
}
