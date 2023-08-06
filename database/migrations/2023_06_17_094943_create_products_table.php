<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('movement_id');
            $table->string('name');
            $table->string('slug');
            $table->string('model')->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('selling_price');
            $table->decimal('discount')->nullable();
            $table->decimal('discount_price')->default(0.00);
            $table->bigInteger('quantity')->nullable();
            $table->string('warranty')->nullable();
            $table->string('resistant')->nullable();
            $table->string('image');
            $table->string('thumb_image')->nullable();
            $table->string('otherimage');
            $table->string('ip_address');
            $table->boolean('status')->default(1);
            $table->boolean('sale')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('banner_id')->references('id')->on('banners');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('series_id')->references('id')->on('series');
            $table->foreign('material_id')->references('id')->on('brand_materials');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('movement_id')->references('id')->on('movements');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
