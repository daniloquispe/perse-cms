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
        Schema::create('seo_tags', function (Blueprint $table)
		{
            $table->id();
			$table->integer('owner_id');
			$table->string('owner_type');
			$table->string('slug', 255)->nullable()->unique();
			$table->string('meta_title', 150);
			$table->string('meta_description', 300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_tags');
    }
};
