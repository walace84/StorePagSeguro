<?php

namespace App\Models;

use GuzzleHttp\Client as Guzz;

trait PagSeguroTrait
{
	// Metodo que contem os dados usuario
    public function getConfig()
    {
        return [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
        ];
    }

    // para poder alterar a moeda.
    public function setCurrency($currency)
    {
    	$this->currency = $currency;
    }

    // metodo para obter os itens
    // na model pagseguro.php temos o objeto cart, que é da model Cart.php que tem o metodo
    // getItens que pega os itens do carrinho.
    public function getItens()
    {
        // para pegar mais de um item.
        $itens = [];
        // objeto cart e o metodo da model cart.php.
        $itensCart = $this->cart->getItens();
        //quantidade do produto no momento.quando passar no loop acrescenta.
        $prod = 1;

        foreach ($itensCart as $item) {

           $itens["itemId{$prod}"]          = $item['item']->id;
           $itens["itemDescription{$prod}"] = $item['item']->description;
           $itens["itemAmount{$prod}"]      = number_format($item['item']->price, 2, '.', '');
           //$itens["itemAmount{$prod}"]      = "{$item['item']->price}0";
           $itens["itemQuantity{$prod}"]    = $item['qtd'];

           $prod ++;
        }

        return $itens;

        /*
    	return [
    		'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => '99999.99',
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            'itemId2' => '0002',
            'itemDescription2' => 'Produto PagSeguroII',
            'itemAmount2' => '99999.98',
            'itemQuantity2' => '2',
            'itemWeight2' => '750',
    	];
        */
    }

    // os dados do comprador.
    public function getSender()
    {
    	return [
    		'senderName'       => $this->user->name,
            'senderAreaCode'   => $this->user->area_code,
            'senderPhone'      => $this->user->phone,
            'senderEmail'      => $this->user->email,
            'senderCPF'        => $this->user->cpf,
    	];
    }

    // os dados de entrega.
    public function getShipping()
    {
    	return [
    		'shippingType'                 => '1',
            'shippingAddressStreet'        => $this->user->street,
            'shippingAddressNumber'        => $this->user->number,
            'shippingAddressComplement'    => $this->user->complement,
            'shippingAddressDistrict'      => $this->user->district,
            'shippingAddressPostalCode'    => $this->user->postal_code,
            'shippingAddressCity'          => $this->user->city,
            'shippingAddressState'         => $this->user->state,
            'shippingAddressCountry'       => $this->user->country,
    	];
    }


 }