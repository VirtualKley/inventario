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
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')->references('id')->on('models')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->decimal('precio_compra');
            $table->decimal('precio_venta');
            $table->integer('stock');
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
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign('projects_model_id_foreign');
            $table->dropColumn('model_id');
            $table->dropForeign('projects_color_id_foreign');
            $table->dropColumn('color_id');
        });
        Schema::dropIfExists('products');
    }
}
