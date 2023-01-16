<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('og_slug')->nullable();
            $table->string('slug')->unique();
            $table->string('seo_keywords', 60)->nullable();
            $table->string('seo_description', 155)->nullable();
            $table->string('author')->nullable();
            $table->integer('views')->default(0);
            $table->string('category')->nullable();
            $table->string('card_image', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
