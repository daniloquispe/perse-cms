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
        Schema::create('subscribers', function (Blueprint $table)
		{
            $table->id();
			$table->string('name')->nullable();
			$table->string('email')->unique();
			$table->string('phone')->nullable();
			$table->foreignIdFor(\App\Models\BookCategory::class, 'book_category_id_1')->nullable();
			$table->foreignIdFor(\App\Models\BookCategory::class, 'book_category_id_2')->nullable();
			$table->foreignIdFor(\App\Models\BookCategory::class, 'book_category_id_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
