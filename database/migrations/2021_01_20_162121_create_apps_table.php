<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->text('icon');
            $table->text('google_play_url');
            $table->text('apple_store_url');
            $table->text('web_url');
            $table->string('google_play_id', 191)->unique(); // app id on Google Play
            $table->string('apple_store_id', 191)->unique(); // app id on Apple Store
            $table->string('genre', 191);
            $table->string('google_score', 10);
            $table->string('apple_score', 10);
            $table->string('google_ratings', 10);
            $table->string('apple_ratings', 10);
            $table->string('price', 10);
            $table->string('currency', 10)->nullable();
            $table->tinyInteger('is_free')->default(1)->comment('1: free, 0: not free');
            $table->string('developer', 100)->nullable();
            $table->text('developer_url')->nullable();
            $table->text('developer_website')->nullable();
            $table->string('google_install_cnt', 100)->nullable();
            $table->string('google_release_date', 100)->nullable();
            $table->string('google_update_date', 100)->nullable();
            $table->string('apple_release_date', 100)->nullable();
            $table->string('apple_update_date', 100)->nullable();
            $table->text('description')->nullable();
            $table->text('description_html')->nullable();
            $table->string('content_rating', 10)->nullable();
            $table->string('android_version', 10)->nullable();
            $table->string('android_size', 10)->nullable();
            $table->string('ios_version', 10)->nullable();
            $table->string('ios_size', 10)->nullable();
            $table->string('required_android_version', 100)->nullable();
            $table->string('required_ios_version', 100)->nullable();
            $table->text('screenshots')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('fare_system')->nullable();
            $table->text('store_review')->nullable();
            $table->text('admin_note')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: draft, 1: published');
            $table->timestamps();

            // foreign
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // index
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
