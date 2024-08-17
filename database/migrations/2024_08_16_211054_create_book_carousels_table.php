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
        Schema::create('book_carousels', function (Blueprint $table)
		{
            $table->id();
			$table->mediumInteger('order')->default(0)->index();
			$table->string('title', 50)->unique();
			$table->enum('zone', array_column(\App\BookCarouselZone::cases(), 'value'));
			$table->foreignIdFor(\App\Models\Book::class)->nullable();
			$table->string('can_be_visible')->default(true);
            $table->timestamps();
        });

		Schema::create('book_carousel', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\BookCarousel::class);
			$table->foreignIdFor(\App\Models\Book::class);
			$table->smallInteger('order')->default(0)->index();
			$table->string('is_visible')->default(true);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_carousel');
        Schema::dropIfExists('book_carousels');
    }
};
