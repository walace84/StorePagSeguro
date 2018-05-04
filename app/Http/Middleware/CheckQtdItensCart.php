<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Cart;

class CheckQtdItensCart
{
    /**
     * Middleware para verificar se existe itens no carrinho.
     * sempre registra os middleware no Kernel
     */
    public function handle($request, Closure $next)
    {
        // chama o objeto cart
        $cart = new Cart();
        // chama o metodo que verifica quantidade de itens.
        if($cart->totalItens() < 1 )

            return  redirect()->back()->with('error', 'Não existe itens no carrinho!');  

        return $next($request);
    }
}
