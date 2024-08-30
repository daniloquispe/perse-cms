<?php

namespace App\Models;

use App\CommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
	use HasFactory;

	protected $fillable = ['book_id', 'customer_id', 'name', 'email', 'rate', 'comment', 'status'];

	protected $casts = ['status' => CommentStatus::class];

	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}

	public function author(): BelongsTo
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}
}
