<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 255);
            $table->string('type', 255);
            $table->string('identifier')->unique();
            $table->boolean('required')->default(false);
            $table->boolean('multiple')->default(false);
            $table->text('details')->nullable();
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('data_inputs');
    }
}
