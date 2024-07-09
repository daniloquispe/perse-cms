<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarqueeItem extends Model
{
    use HasFactory;

	protected $fillable = ['is_visible', 'text', 'order', 'url', 'background_color', 'text_color'];
}
