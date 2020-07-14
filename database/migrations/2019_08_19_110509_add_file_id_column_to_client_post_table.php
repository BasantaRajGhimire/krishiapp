<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileIdColumnToClientPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_post', function (Blueprint $table) {
            $table->unsignedInteger('file_id')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_post', function (Blueprint $table) {
            if (Schema::hasColumn('client_post', 'file_id')) {
                $table->dropColumn('file_id');
            }
        });
    }
}
