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
        Schema::create('marquee_items', function (Blueprint $table)
		{
			$table->id();
			$table->string('text', 150);
			$table->string('url', 255)->nullable();
			$table->boolean('is_visible')->default(true);
			$table->tinyInteger('order')->default(0)->index();
			$table->string('text_color', 7)->nullable();
			$table->string('background_color', 7)->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marquee_items');
    }
};
