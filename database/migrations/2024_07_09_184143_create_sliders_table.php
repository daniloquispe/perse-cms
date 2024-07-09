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
        Schema::create('sliders', function (Blueprint $table)
		{
			$table->id();
			$table->string('name', 100);
			$table->unsignedSmallInteger('delay', 3000);
			$table->boolean('is_visible');
			$table->timestamps();
        });

		Schema::create('slides', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\Slider::class);
			$table->tinyInteger('order')->index();
			$table->string('name', 100);
			$table->string('image', 255);
			$table->string('url', 255)->nullable();
			$table->boolean('is_enabled');
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::dropIfExists('slides');
		Schema::dropIfExists('sliders');
    }
};
