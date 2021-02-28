<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionalColumnsToEntryRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entry_rows', function (Blueprint $table) {
            $table->integer('private')->default(false);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entry_rows', function (Blueprint $table) {
            $table->integer('private')->default(false);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }
}
