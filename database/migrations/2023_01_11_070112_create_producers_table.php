<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('producers')) {
            Schema::create('producers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('wine_user_id');
                $table->unsignedBigInteger('country_id');
                $table->string('name')->nullable();
                $table->string('slug')->nullable();
                $table->integer('status')->default(1);
                $table->integer('is_approved')->default(1);
                $table->timestamps();
                $table->foreign('wine_user_id')->references('id')->on('wine_users')->onDelete('cascade');
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producers');
    }
};
