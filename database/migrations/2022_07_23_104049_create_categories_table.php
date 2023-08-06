<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug');
            $table->string('brandChild');
            $table->string('image')->nullable();
            $table->integer('created_by');
            $table->boolean('is_homepage')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('ip_address')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });

        // create default one
        $category = new Category();
        $category->name = 'Test Category';
        $category->slug = 'test-category';
        $category->created_by = 1;
        $category->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
