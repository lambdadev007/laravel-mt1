<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepairsSubCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs_sub_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('belongs_to')->default('first');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('repairs_sub_category');
    }
}
