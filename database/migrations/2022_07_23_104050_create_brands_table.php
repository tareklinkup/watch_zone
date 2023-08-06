<?php

use App\Models\Brand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Expr\New_;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('slug');
            $table->string('image')->nullable();
            $table->boolean('is_homepage')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        $brand = new Brand();
        $brand->name = 'fossil';
        $brand->created_by = 1;
        $brand->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
