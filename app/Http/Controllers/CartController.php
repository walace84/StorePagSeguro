<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//== Models de produto ==//
use App\Models\Product;
// == Models de cart == //
use App\Models\Cart;
// Class de Sessão
use Session;

class CartController extends Controller
{
	// == Adiciona um produto pelo seu ID == //
    public function add($id)
    {
    	// chama a model produto para pegar o produto pelo ID.
    	$product = Product::find($id);
    	// verifica se o produto existe.
    	if(!$product)
    	{
    		return redirect()->back();
    	}
    	// chama a model cart, que é responsavel para quarda o produto no carrinho.
    	$cart = new Cart;
    	// metodo add e o produto a ser adicionado.
    	$cart->add($product);
    	// armazena o produto em uma sessão, primeiro lugar que criei a sessão
    	// automaticamente aceita adicionar mais itens por estar em uma sessão.
    	Session::put('carrinho', $cart);

    	return redirect()->route('cart');
    }

    // remove um produto.
    public function remove($id)
    {
    	$product = Product::find($id);

    	if(!$product)
    		return redirect()->back();

    	$cart = new Cart;

    	$cart->remove($product);

    	Session::put('carrinho', $cart);

    	return redirect()->route('cart');

    }
}
