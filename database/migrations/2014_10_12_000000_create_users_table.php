<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin','guest'])->default('guest');
            $table->string('phone_number',20)->unique();
            $table->rememberToken();
            $table->timestamps();
        });

        $timestampAdmin = date('Y-m-d H:i:s');
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@catadopt.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'phone_number' => '628982002040',
            'created_at' => $timestampAdmin,
            'updated_at' => $timestampAdmin
        ]);

        $timestampGuest = date('Y-m-d H:i:s');
        DB::table('users')->insert([
            'name' => 'Guest',
            'email' => 'guest@catadopt.com',
            'password' => Hash::make('guest'),
            'role' => 'guest',
            'phone_number' => '628982002041',
            'created_at' => $timestampGuest,
            'updated_at' => $timestampGuest
        ]);
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
