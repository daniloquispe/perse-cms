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
        Schema::create('book_categories', function (Blueprint $table)
		{
			$table->id();
			$table->unsignedTinyInteger('order')->nullable();
			$table->string('name', 50);
			$table->string('menu_title', 50)->nullable();
			$table->string('search_results_label', 50)->nullable();
			$table->foreignIdFor(\App\Models\BookCategory::class, 'parent_id')->nullable();
			$table->boolean('is_visible')->default(true);
			$table->timestamps();

			$table->unique(['name', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_categories');
    }
};
