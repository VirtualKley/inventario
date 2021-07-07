<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('total');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });

        Schema::create('product_sale', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->integer('cantidad');
            $table->decimal('precio_compra');
            $table->decimal('subtotal_compra');
            $table->decimal('precio_venta');
            $table->decimal('subtotal_venta');
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
        // Schema::table('product_sale', function(Blueprint $table){
        //     $table->dropForeign('product_sale_product_id_foreign');
        //     $table->dropColumn('product_id');
        //     $table->dropForeign('product_sale_sale_id_foreign');
        //     $table->dropColumn('sale_id');
        // });
        Schema::dropIfExists('product_sale');

        // Schema::table('sales', function(Blueprint $table){
        //     $table->dropForeign('sales_user_id_foreign');
        //     $table->dropColumn('user_id');
        // });
        Schema::dropIfExists('sales');
    }
}
