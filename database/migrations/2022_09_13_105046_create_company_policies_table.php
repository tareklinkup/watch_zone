<?php

use App\Models\CompanyPolicy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Expr\New_;

class CreateCompanyPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_policies', function (Blueprint $table) {
            $table->id();
            $table->longText('map_link')->nullable();
            $table->longText('delivery_desc');
            $table->longText('phycal_desc');
            $table->longText('warranty_desc');
            $table->string('ip_address')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        $user = new CompanyPolicy ();
        $user->delivery_desc = 'fast delivery';
        $user->phycal_desc = 'phycal  store';
        $user->warranty_desc = 'warranty Description';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_policies');
    }
}
