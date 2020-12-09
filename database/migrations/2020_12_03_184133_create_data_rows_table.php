<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_rows', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 255);
            $table->string('data_type', 255);
            $table->integer('order')->default(1);
            $table->boolean('is_multiple')->default(false);
            $table->text('validations')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('data_rows');
    }
}
