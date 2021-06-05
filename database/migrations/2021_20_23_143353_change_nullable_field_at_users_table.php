<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullableFieldAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('alamat')->nullable()->change();
            $table->integer('provinces_id')->nullable()->change();
            $table->integer('regencies_id')->nullable()->change();
            $table->integer('zip_code')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('nomor_WA')->nullable()->change();
            $table->string('id_member')->nullable()->change();
            $table->integer('categories_id')->nullable()->change();
            $table->integer('member_status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('alamat')->nullable(false)->change();
            $table->integer('provinces_id')->nullable(false)->change();
            $table->integer('regencies_id')->nullable(false)->change();
            $table->integer('zip_code')->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('nomor_WA')->nullable(false)->change();
            $table->string('id_member')->nullable(false)->change();
            $table->integer('categories_id')->nullable(false)->change();
            $table->integer('member_status')->nullable(false)->change();
        });
    }
}