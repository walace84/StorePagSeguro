<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models de produtos
use App\Models\Product;
// models de cart
use App\Models\Cart;
// Sessão
use Session;

class StoreController extends Controller
{
	// Rota inicial. injeção da model product
    // Pega todos os produtos no banco
    // Atribui a uma variável e passar por parametro
    // para a view.
    public function index(Product $product)
    {
        $products = $product->all();

    	return view('store.home.index', compact('products'));
    }

    // carrinho de compras
    public function cart()
    {
        $title = "Meu carrinho de compras";

        $cart = new Cart();

        $products = $cart->getItens();

        //dd($cart->getItens());
        //dd($cart->total());
        //dd($cart->totalItens());

    	return view('store.cart.cart', compact('title', 'cart', 'products'));
    }

    // para escolher o metodo de pagamento.
    public function methodPayment()
    {
        $title = 'Escolha o método de pagamento';

        return view('store.payment.payment', compact('title'));
    }

}
