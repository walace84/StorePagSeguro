<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Order;

class UserController extends Controller
{
	// EXIBE O PERFIL
    public function profile()
    {
    	$title = 'Meu perfil';
    	
    	return view('store.user.profile', compact('title'));
    }


    // METODO DE ATUALIZAR OS DADOS NO SISTEMA
    // chama a requisição e a model de User
    public function profileUpdate(Request $request, User $user)
    {
        // METODO DE VALIDAÇÃO DO USERCONTROLLER.
        $this->validate($request, $user->rulesUpdateProfile());

        $dataform = $request->all();
        // caso a pessoa tente manipular o console do navegador.
        if( isset($dataform['email']))
            unset($dataform['email']);
        if( isset($dataform['cpf']))
            unset($dataform['cpf']);
        // passo para profileupdate, os dados.
        $update = auth()->user()->profileUpdate($dataform);

        if($update)
            return redirect()->route('profile')->with('message', 'Perfil atualizado com Sucesso!');

        return redirect()->back()->with('error', 'Falha ao atualizar cadastro');   
    }

    // Retorna a view da senha
    public function password()
    {
        $title = 'minha senha';

        return view('store.user.password', compact('title'));
    }

    // Metodo para atualizar a senha
    public function passwordUpdate(Request $request, User $user)
    {
        // METODO DE VALIDAÇÃO.
        $this->validate($request, $user->rulesPassword());

        $update = auth()->user()->updatePassword($request->password);

        if($update)
            return redirect()->route('password')->with('message', 'Senha atualizada com Sucesso!');

        return redirect()->back()->with('error', 'Falha ao atualizar senha'); 
    }


    // METODO DE SAIR DO SISTEMA
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }


    // listar meus pedidos.
    public function myOrders(Order $order)
    {
        $title = "Meus Pedidos";
        // pega a model de ordens busca pelo usuário e lista seu produto.
        // implementação está na order.php
        $orders = $order->user()->get();

        return view('store.order.order', compact('title', 'orders'));
    }


    // para mostrar os detalhes do pedido. recebe a referencia
    public function detailsOrder(Order $order, $reference)
    {

        $order = $order->user()->where('reference', $reference)->get()->first();

        if(!$order)
            return redirect()->back();

        $title = "Detalhes do pedido {$order->id}";
        // chama o método products(), que está no order.php, fazendo o relacionamento com a model product.php
        $products = $order->products()->get();

        return view('store.order.product', compact('title', 'order', 'products'));
        
    }

}
