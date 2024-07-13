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
        Schema::create('pages', function (Blueprint $table)
		{
			$table->id();
			$table->string('name', 50)->index();
			$table->string('slug')->unique()->nullable();
			$table->string('title', 150);
			$table->text('content')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('meta_title', 150)->nullable();
			$table->string('meta_description', 150)->nullable();
			$table->boolean('is_visible')->default(true);
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
