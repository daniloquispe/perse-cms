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
		Schema::create('books', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\BookCategory::class, 'category_id');
			$table->foreignIdFor(\App\Models\Saga::class)->nullable();
			$table->foreignIdFor(\App\Models\Publisher::class)->nullable();
			$table->foreignIdFor(\App\Models\BookFormat::class, 'format_id')->nullable();
			$table->foreignIdFor(\App\Models\BookAgeRange::class, 'age_range_id')->nullable();
			$table->boolean('is_visible');
			$table->string('sku')->unique();
			$table->string('isbn', 13);
			$table->string('cover', 255)->nullable();
			$table->string('title', 150)->unique();
			$table->text('summary')->nullable();
			$table->unsignedSmallInteger('year')->nullable();
			$table->unsignedInteger('pages_count')->nullable();
			$table->decimal('weight')->nullable();
			$table->decimal('width')->nullable();
			$table->decimal('height')->nullable();
			$table->decimal('price');
			$table->boolean('is_presale')->default(false);
			$table->timestamps();
		});

		Schema::create('author_book', function (Blueprint $table)
		{
			$table->foreignIdFor(\App\Models\Book::class);
			$table->foreignIdFor(\App\Models\Author::class);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('author_book');
		Schema::dropIfExists('books');
	}
};
