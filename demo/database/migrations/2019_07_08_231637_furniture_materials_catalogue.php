<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FurnitureMaterialsCatalogue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture_materials_catalogue', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image', 255)->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('locale')->default('ka');
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
        Schema::dropIfExists('furniture_materials_catalogue');
    }
}
