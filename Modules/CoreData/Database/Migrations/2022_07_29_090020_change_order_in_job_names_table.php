<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrderInJobNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_names', function (Blueprint $table) {
            $table->dropIndex('job_names_order_unique');
            $table->integer('order')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_names', function (Blueprint $table) {
            $table->integer('order')->unique()->change();
        });
    }
}
