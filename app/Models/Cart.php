<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Models de product //
use App\Models\Product;
// Sessão
use Session;

class Cart extends Model
{

	private $itens = [];
	// toda vez que o metodo Cart, for chamado ele executa o construtor.
	public function __construct()
	{
		// se existir a sessão de carrinho, armazena no array private itens.
		if(Session::has('carrinho'))
		{
			// obtem a sessão de carrinho
			$cart = Session::get('carrinho');
			// passa os itens para o array.
			$this->itens = $cart->itens;
		}
	}

	// == LOGICA QUE ADICIONA OS PRODUTOS == //
	// Model do carrinho de compras, chamando a injeção DI, da model produto
	// para ter certeza que está adicionado os produtos.
    public function add(Product $product)
    {
    	// se não existe 1 produto, se existir + 1
    	if(isset($this->itens[$product->id]))
    	{
    		$this->itens[$product->id] = [
    		'item' => $product,
    		'qtd'  => $this->itens[$product->id]['qtd'] + 1,
    		];	
    	}
    	else
    	{
    		$this->itens[$product->id] = [
    		'item' => $product,
    		'qtd'  => 1,
    		];
    	}
    	
    }

    // remove um produto
    // se tiver mais que um produto, decrementa - 1 , se tiver somente 1 remove ele.
    public function remove(Product $product)
    {
    	if(isset($this->itens[$product->id]) && $this->itens[$product->id]['qtd'] > 1)
    	{
    		$this->itens[$product->id] = [
    		'item' => $product,
    		'qtd'  => $this->itens[$product->id]['qtd'] - 1,
    		];	
    	}
    	elseif($this->itens[$product->id])
    	{
    		unset($this->itens[$product->id]);
    	}
    }

    // soma o valor da quantidade do produtos.
    public function total()
    {
    	$total = 0;

    	foreach ($this->itens as $item) {

    		$subtotal = $item['item']->price * $item['qtd'];

    		$total += $subtotal;
    	}

    	return $total;
    }

    // total de itens
    public function totalItens()
    {
    	return count($this->itens);
    }

    // limpa o carrinho
    public function emptyCart()
    {
    	if(Session::has('carrinho'))
    		Session::forget('carrinho');
    }

    // retorna os itens no carrinho.
    public function getItens()
    {
    	return $this->itens;
    }
}
