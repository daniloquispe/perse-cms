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
        Schema::create('addresses', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\Customer::class);
			$table->unsignedMediumInteger('department_id');
			$table->string('department_name');
			$table->unsignedMediumInteger('province_id');
			$table->string('province_name');
			$table->unsignedMediumInteger('district_id');
			$table->string('district_name');
			$table->string('address', 100);
			$table->string('location_number', 100);
			$table->string('reference', 100)->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
