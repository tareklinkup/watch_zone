<?php

use App\Models\About;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->longText('terms_desc');
            $table->longText('privacy_desc');
            $table->longText('customer_service');
            $table->integer('updated_by')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        // create default one 
        $content = new About();
        $content->privacy_desc = 'privacy policy description';
        $content->terms_desc = 'terms Description';
        $content->customer_service = 'sale  Service';
        $content->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
