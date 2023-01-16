<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('og_slug')->nullable();
            $table->string('slug')->unique();
            $table->string('seo_keywords', 60)->nullable();
            $table->string('seo_description', 155)->nullable();
            $table->integer('views')->default(0);
            $table->string('image', 255)->nullable();
            $table->mediumText('slides')->nullable();
            $table->string('category')->nullable();
            $table->string('starts')->nullable();
            $table->string('ends')->nullable();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('area')->nullable();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
            $table->text('materials')->nullable();
            $table->text('hidden_fields')->nullable();
            $table->enum('soft_delete', ['false', 'true'])->default('false')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
