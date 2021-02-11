<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->string('link');
            $table->string('foreign_id');
            $table->string('site');
            $table->string('image')->nullable();
            $table->unsignedInteger('area');
            $table->unsignedInteger('price');
            $table->boolean('sendable');
            $table->timestamps();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->unique(['site', 'foreign_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
