<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->bigInteger('role_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default('no.png');
            $table->rememberToken();
            $table->timestamps();
        });

        // creaete default one 
        $user = new User();
        $user->name = 'Mr. Admin';
        $user->email = 'admin@gmail.com';
        $user->username = 'admin';
        $user->role_id = 1;
        $user->password = Hash::make('1');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
