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
		Schema::create('orders', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\Customer::class);
			$table->foreignIdFor(\App\Models\Coupon::class)->nullable();
			$table->string('number', 25);
			$table->string('email', 150);
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('id_document_number', 11);
			$table->string('phone', 50);
			$table->unsignedTinyInteger('invoice_type')->nullable();  // Nullable only during non-ERP-integration stage
			$table->string('ruc', 11)->nullable();
			$table->string('business_name', 100)->nullable();
			$table->unsignedMediumInteger('department_id');
			$table->string('department_name');
			$table->unsignedMediumInteger('province_id');
			$table->string('province_name');
			$table->unsignedMediumInteger('district_id');
			$table->string('district_name');
			$table->string('address', 100);
			$table->string('location_number', 100);
			$table->string('reference', 100)->nullable();
//			$table->foreignIdFor(\App\Models\Address::class);
			$table->string('recipient_name', 100)->nullable();
			$table->date('delivery_date');
			$table->unsignedInteger('delivery_price')->default(0);
			$table->unsignedTinyInteger('payment_method_type');
			$table->json('payment_method_info');
			$table->date('confirmed_at')->nullable();
			$table->date('delivering_at')->nullable();
			$table->date('delivered_at')->nullable();
			$table->date('cancelled_at')->nullable();
			$table->timestamps();
		});

		Schema::create('order_items', function (Blueprint $table)
		{
			$table->id();
			$table->foreignIdFor(\App\Models\Order::class);
			$table->foreignIdFor(\App\Models\Book::class);
			$table->unsignedTinyInteger('quantity');
			$table->unsignedInteger('gross_price');
			$table->unsignedInteger('discounted_price')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('order_items');
		Schema::dropIfExists('orders');
	}
};
