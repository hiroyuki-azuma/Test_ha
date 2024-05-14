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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('product_name');
            $table->text('img_path')->nullable();
            $table->integer('price');
            $table->integer('stock');
            // $table->integer('company');
            $table->text('comment');
            $table->timestamps();
            // 論理削除用に追記
            $table->softDeletes()->nullable();


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
};
