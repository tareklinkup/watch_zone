<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                    ->constrained('customers')
                    ->onDelete('cascade');
            $table->string('name', 60);
            $table->string('b_name', 60)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('b_email', 100)->nullable();
            $table->string('phone', 15);
            $table->string('b_phone', 15)->nullable();
            $table->string('district', 60)->nullable();
            $table->string('b_district', 60)->nullable();
            $table->string('address');
            $table->string('b_address')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('amount');
            $table->decimal('total_amount', 18,2);
            $table->decimal('couponDiscount')->nullable();
            $table->string('order_number')->nullable();
            $table->string('invoice_no')->nullable();
            $table->decimal('ship_charge')->nullable();
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('status', 60)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
