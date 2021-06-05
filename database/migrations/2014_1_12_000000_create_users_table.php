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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('verifikasi_email')->nullable();
            $table->integer('categories_id');
            $table->integer('member_status');
            $table->longText('alamat');
            $table->integer('provinces_id');
            $table->integer('regencies_id');
            $table->string('password');
            $table->integer('zip_code');
            $table->string('country');
            $table->string('nomor_WA');
            $table->string('id_member');
            

            $table->softDeletes();
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
