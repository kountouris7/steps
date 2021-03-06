<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cron_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('command');
            $table->integer('next_run');
            $table->integer('last_run');
            $table->timestamps();
            //$table->primary('command');
            //$table->index('next_run');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cron_entries');
    }
}
