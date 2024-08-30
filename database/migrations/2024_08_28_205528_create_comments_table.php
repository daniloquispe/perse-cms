<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('comments', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\Book::class);
			$table->foreignIdFor(\App\Models\Customer::class);
			$table->string('name', 150);
			$table->string('email', 150);
			$table->unsignedTinyInteger('rate');
			$table->text('comment');
			$table->enum('status', array_column(\App\CommentStatus::cases(), 'value'))->default(\App\CommentStatus::Pending);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('comments');
	}
};
