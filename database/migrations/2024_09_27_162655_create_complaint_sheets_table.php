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
        Schema::create('complaint_sheets', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\Customer::class)->nullable();

			// 1. Identity
			$table->string('name');
			$table->string('id_document_number');
			$table->string('address');
			$table->string('email');
			$table->string('phone', 50)->nullable();

			// 2. Purchased product/service
			$table->boolean('is_service')->default(false);
			$table->decimal('amount')->nullable();

			// 3. Detail
			$table->text('detail');
			$table->text('request')->nullable();

			// 4. Reply
			$table->text('reply');
			$table->date('replied_at')->nullable();

			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_sheets');
    }
};
