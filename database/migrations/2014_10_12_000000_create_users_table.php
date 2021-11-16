<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('user_id');
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email', 24)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('password');
            $table->string('evc')->nullable();
            $table->string('referral_code');
            $table->integer('bank_id')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('last_login')->nullable();
            $table->string('login_count')->nullable();
            $table->string('last_ip_used')->nullable();
            $table->char('initials', 3)->default(1);
            $table
                ->enum('status', ['pending', 'active', 'dormant', 'block'])
                ->default('active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
