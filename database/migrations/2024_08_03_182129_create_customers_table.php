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
        Schema::create('customers', function (Blueprint $table)
		{
			$table->id();
			$table->string('first_name', 100)->nullable()->index();
			$table->string('last_name', 100)->nullable()->index();
			$table->string('email', 150);
			$table->string('phone', 50)->nullable();
			$table->date('birthdate')->nullable();
			$table->string('id_document_number', 11)->nullable();
			$table->char('gender')->nullable();
			$table->boolean('is_subscribed')->default(false);
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();

			$table->unique(['email', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
