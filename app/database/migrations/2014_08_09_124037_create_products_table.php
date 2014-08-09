<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('products', function($table) {
            $table->increments('id');
            //$table->string('email')->unique();
            $table->string('name');
            $table->string('short_description');
            $table->string('description');
            $table->float('price');
            $table->integer('stock');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop('products');
    }

}
