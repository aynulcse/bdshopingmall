<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->nullable();
            $table->integer('sub_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('quantity')->default(1);
            $table->integer('price');
            $table->integer('image');
            $table->integer('image2');
            $table->integer('image3');
            $table->integer('image_small');
            $table->integer('image2_small');
            $table->integer('image3_small');
            $table->integer('status')->default(0);
            $table->integer('offer_price')->nullable();
            $table->integer('admin_id')->unsigned();
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
        Schema::dropIfExists('products');
    }
}
