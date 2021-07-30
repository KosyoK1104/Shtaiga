<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128);
            $table->text('make');
            $table->text('model');
            $table->year('year');
            $table->text('slug');
            $table->double('price');
            $table->integer('cubic');
            $table->integer('mileage');
            $table->foreignId('fuel_id');
            $table->foreignId('gearbox_id');
            $table->text('colour');
            $table->longText('description')->default("");
            $table->integer('views')->default(0);
            $table->integer('hp');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('telephone');
            $table->text('town');
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
        Schema::dropIfExists('listings');
    }
}
