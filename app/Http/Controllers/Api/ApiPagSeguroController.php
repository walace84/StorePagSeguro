<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PagSeguro;
use App\Models\Order;

class ApiPagSeguroController extends Controller
{
	// Recebe um códido de resposta da model pagseguro.php, chama o model Order que tem o 
	// metodo changeStatus que atualiza o status do pedido
    public function request(Request $request, PagSeguro $pagseguro, Order $order)
    {
    	// trta o erro.
    	if(!$request->notificationCode)
    		return response()->json(['error' => 'NotNotificationCode'], 404);
    	// metodo do pagseguro.php
    	$response = $pagseguro->getStatusTransation($request->notificationCode);
    	// pega a referencia que vem da consulta do getStatusTrasation
    	$order = $order->where('reference', $response['reference'])->get()->first();

    	$order->changeStatus($response['status']);

    	return response()->json(['success' => true]);

    }


}
