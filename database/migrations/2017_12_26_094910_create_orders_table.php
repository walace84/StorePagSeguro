<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * ESSE SÃO Todos OS dados do pedido do usuario
     * referenciando os produtos ao usuário
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            // ID do produto
            $table->increments('id');
            // referencia do usuario com o produto
            $table->integer('user_id')->unsigned();
            // deletar o produto caso usuario seja deletado
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // referencia unica do produto
            $table->string('reference', 191)->unique();
            $table->string('code', 191)->unique();
            // status da aprovação do pedido tem na duc do pagseguro
            $table->enum('status', [1,2,3,4,5,6,7,8,9]);
            // os tipos de pagamento
            $table->enum('payment_method', [1,2,3,4,5,6,7]);
            // a data que o pedido foi feito
            $table->date('date');
            // o refresh do status de pagamento
            $table->date('date_refresh_status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
