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
            $table->increments('id');
            $table->string('username')->unique()->index();
            $table->string('fullname')->index();
            $table->string('email')->nullable()->unique()->index();
            $table->string('mobile')->unique()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('approve')->default(0);
            $table->integer('status')->default(1);
            $table->integer('job_name_id')->nullable()->index()->default(0);
            $table->string('description')->nullable();
            $table->integer('gender_id')->nullable()->index()->default(0);
            $table->integer('nationality_id')->nullable()->index()->default(0);
            $table->integer('country_id')->nullable()->index()->default(0);
            $table->integer('city_id')->nullable()->index()->default(0);
            $table->integer('state_id')->nullable()->index()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('nationality_number')->nullable()->unique()->index();
            $table->string('tax_number')->unique()->index()->nullable();
            $table->string('commercial_number')->unique()->index()->nullable();
            $table->string('password');
            $table->text('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
