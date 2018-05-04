<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// pagote Guzzle, FOI BAIXADO NO JSON
use GuzzleHttp\Client as Guzz;

use App\Models\Cart;

// Essa classe está servindo de dependencia para o controller pagseguro.

/************************************************************************/
/*          CRIAMOS UMA TRAiT PARA ARMAZANAR OS METODOS                 */
/************************************************************************/                                                           

class PagSeguro extends Model
{

    use PagSeguroTrait;
    // referencia do pedido.
    private $cart, $reference, $user;

    protected $currency = 'BRL';
    /* obs o que é posto no construtor fica dentro das variaveis de atributos */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->reference = uniqid(date('YmdHis'));
        // para não precisar ficar chamando toda vez o auth().
        $this->user = auth()->user();
    }




    // == PAGAMENTO COM BOLETO COM CHECKOUT TRANSPARENTE == //
    public function paymentBillet($sendHash)
    {
        $params = [
            
            'senderHash'    => $sendHash,
            'paymentMode'   => 'default',
            'paymentMethod' => 'boleto',
            'currency'      => $this->currency,
            'reference'     => $this->reference,
        ];
        //$params = http_build_query($params);
        $params = array_merge($params, $this->getConfig());
        $params = array_merge($params, $this->getItens());
        $params = array_merge($params, $this->getSender());
        $params = array_merge($params, $this->getShipping());

        $guzz = new Guzz;
        // URL DE PAGAMENTO TRANSPARENTE.
        $reponse = $guzz->request('POST', config('pagseguro.url_payment_transparente'), [
            // esse form_params é da guzzler
            'form_params' => $params,

        ]);
        $body = $reponse->getBody();
        $content = $body->getContents();

        $xml = simplexml_load_string($content);
        // link de pagamento do boleto. vem varias configuração no retorno do xml.
        return [
            'success'    => true,
            'link'       => (string)$xml->paymentLink,
            'reference'  => $this->reference,
            'code'       => (string)$xml->code,
        ]; 
    }
    // == FIM PAGAMENTO COM BOLETO == //


    // == PAGAMENTO COM CARTÃO == //
    public function paymentCredCard($request)
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
            'senderHash' => $request->senderHash,
            'paymentMode' => 'default',
            'paymentMethod' => 'boleto',
            'currency' => 'BRL',
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
            'reference' => 'REF1234',
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '99999999',
            'senderEmail' => 'c37628999791810081145@sandbox.pagseguro.com.br',
            'senderCPF' => '10976381702',
            'shippingType' => '1',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'ATA',

            'creditCardToken' => $request->cardCard,
            'installmentQuantity' => '1',
            'installmentValue' => '30021.45',
            'noInterestInstallmentQuantity' => '2',
            'creditCardHolderName' => 'Jose Comprador',
            'creditCardHolderCPF' => '1475714734',
            'creditCardHolderBirthDate' => '01/01/1900',
            'creditCardHolderAreaCode' => '9',
            'creditCardHolderPhone' => '9999999',
            'billingAddressStreet' => 'Av. PagSeguro',
            'billingAddressNumber' => '999',
            'billingAddressComplement' => '9o andar',
            'billingAddressDistrict' => 'Jardim Internet',
            'billingAddressPostalCode' => '9999999',
            'billingAddressCity' => 'Cidade Exemplo',
            'billingAddressState' => 'SP',
            'billingAddressCountry' => 'ATA',
        ];

        $guzz = new Guzz;
        // URL DE PAGAMENTO TRANSPARENTE.
        $reponse = $guzz->request('POST', config('pagseguro.url_payment_transparente'), [
            // esse form_params é da guzzler
            'form_params' => $params,

        ]);
        $body = $reponse->getBody();
        $content = $body->getContents();

        $xml = simplexml_load_string($content);

        return $xml->code;
    }


     // == PAGAMENTO COM CHECKOUT TRANSPARENTE == //
    // faz uma requisição recupera um código para passar para o ID de sessão.
    // para poder fazer o checkout transparente.
    public function getSessionId()
    {
        $params = $this->getConfig();

        $params = http_build_query($params);

        $guzz = new Guzz;
        // URL DA SESSÃO
        $reponse = $guzz->request('POST', config('pagseguro.url_transparente_session'), [
            
            'query' => $params,

        ]);
        $body = $reponse->getBody();
        $content = $body->getContents();
        $xml = simplexml_load_string($content);
        // captura o ID de sessão.
        return $xml->id;
    }


    // método para consultar uma notificação de transação
    public function getStatusTransation($notificationCode)
    {
        // Metodo que contem os dados usuario
        $configs = $this->getConfig();
        //Gera a string de consulta (query) em formato URL
        $params = http_build_query($configs);

        $guzz = new Guzz;
        // URL DE trasation
        $reponse = $guzz->request('GET', config('pagseguro.url_notification')."/{$notificationCode}", [
            // query para quando usa o verbo GET
            'query' => $params,

        ]);
        $body = $reponse->getBody();
        $content = $body->getContents();

        $xml = simplexml_load_string($content);
        // recebe de retorno do pagseguro o status do pedido e sua referencia, tem mais item nesse retorno.
        //dd($xml);die();
        return [
            'status'    => (string) $xml->status,
            'reference' => (string) $xml->reference,
        ];
    }

}
