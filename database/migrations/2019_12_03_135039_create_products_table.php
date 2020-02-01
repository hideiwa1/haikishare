<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table -> integer('jan') -> nullable();
            $table->string('pic') -> nullable();
            $table->text('comment') -> nullable();
            $table->integer('price');
            $table->timestamp('limit');
            $table->integer('category_id')-> nullable();
            $table->boolean('sale_flg') ->default(false);
            $table->integer('store_id')-> nullable();
            $table->boolean('delete_flg') ->default(false);
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
