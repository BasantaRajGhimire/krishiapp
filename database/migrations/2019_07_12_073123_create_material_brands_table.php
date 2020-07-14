<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('material_id');
            $table->integer('material_type_id')->nullable();
            $table->string('brand_name');
            $table->integer('amount');
            $table->longText('brand_description')->nullable();
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
        Schema::dropIfExists('material_brands');
    }
}
