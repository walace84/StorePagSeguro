<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// do laravel.
use Carbon\Carbon;

// == ORDEM DE PEDIDOS == //
class Order extends Model
{	

	protected $fillable = ['user_id', 'reference', 'code', 'status', 'payment_method', 'date'];

	// pega a model de ordens busca pelo usuaio e lista seu produto.
	public function scopeUser($lista)
	{
		return $lista->where('user_id', auth()->user()->id);
	}

	// retorna produtos
    public function products()
    {
    	// a model de Product, faz o relacionamento com a  tabela, product_order
        // e chama o withPivot, para poder dizer qual campo da tabela produtc_order, queremos listar.
    	return $this->belongsToMany(Product::class, 'product_order')->withPivot('qtd', 'price');
    }	

    // CRIA UMA NOVA ORDEM DE PEDIDOS. recebendo alguma informções do carrinho de compra.
    // está sendo instanciado no PagSegurocontroller 
    // status = 1 aguardando pagamento default
    // paymentMethod = 2 boleto por default
    public function newOrderProduct($cart, $reference, $code, $status = 1, $paymentMethod = 2)
    {
    	// id do usuario logado. e os dados da tabela Order.
    	$order = $this->create([
    		'user_id'        => auth()->user()->id,
    		'reference'      => $reference,
    		'code'           => $code,
    		'status'         => $status,
    		'payment_method' => $paymentMethod,
    		'date'           => date('Ymd'),
    	]);

    	$prodOrder = [];
    	// metodo que está na model cart, e que pega a quantidade de itens no carrinho
    	$itensCart = $cart->getItens();
        // 'qtd' é da tabela Product_order, e está recebendo o item['qtd'] da tabela produtos.
    	foreach ($itensCart as $item) {
           
    		$prodOrder[$item['item']->id] = [
    			'qtd'   => $item['qtd'],
    			'price' => $item['item']->price,
    		];

    	}

    	// Cria a ordem de produtos fazendo o relacionamento. Attach vingula não cria.
    	$order->products()->attach($prodOrder);
    }	

    // metodo para saber o status de pagamento.
    public function getStatus($status)
    {
    	$statusA = [
    		1 => 'Aguardando pagamento',
    		2 => 'Em análise',
    		3 => 'Paga',
    		4 => 'Disponível',
    		5 => 'Em disputa',
    		6 => 'Devolvida',
    		7 => 'Cancelada',
    		8 => 'Debitado',
    		9 => 'Retenção temporária',
    	];

    	return $statusA[$status];
    }

    // metodo para exibir o meio d epagamento
    public function getMethodPayment($method)
    {
    	$paymentMethod = [
    		1 => 'Cartão de crédito',
    		2 => 'Boleto',
    		3 => 'Débito online',
    		4 => 'Saldo PagSeguro',
    		5 => 'Oi Paggo',
    		7 => 'Depósito em conta',
    	];

    	return $paymentMethod[$method];
    }

    // para exibir a data no horario brasileiro.
    public function getDateAttribute($value)
    {
    	return Carbon::parse($value)->format('d/m/y');
    }

     // para exibir a data no horario brasileiro.
    public function getDateRefreshStatusAttribute($value)
    {
    	return Carbon::parse($value)->format('d/m/y');
    }


    // Método para atualizar o status do pedido, está em ApiPagSeguroController
    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

}
