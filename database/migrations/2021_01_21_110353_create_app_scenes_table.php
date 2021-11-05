<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_scenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('scene_id');
            // foreign
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->foreign('scene_id')->references('id')->on('scenes')->onDelete('cascade');
            $table->timestamps();

            $table->index(['app_id', 'scene_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_scenes');
    }
}
