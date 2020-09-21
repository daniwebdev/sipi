<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {

            $table->uuid('uuid')->after('id')->unique();
            $table->string('phone')->after('name');
            $table->string('avatar')->nullable();
            $table->bigInteger('access_role_id')->unsigned();

            $table->softDeletes();

            $table->index('id');
            $table->index('uuid');
            $table->index(['email','phone']);
            $table->index('access_role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
