<?php

// == ESSES DADOS ESTÁ DENTRO DO ARQUIVO ENV == //
// SÃO O EMAIL E TOKEN DE ACESSO DO VENDEDOR == //
// que está no site do pagseguro está em sandbox, venderdor, ver credenciais e sempre ATIVA. 

$envirorinment = env('PAGSEGURO_ENVORINMENT');
// VERIFICA SE ESTAR NO EMBIENTE SANDBOX OU PRODUCTION
$isSandBox = ($envirorinment == 'sandbox') ? true : false;

$urlCheckout                      = ($isSandBox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout' : 'https://ws.pagseguro.uol.com.br/v2/checkout';

$urlRedirectAfterRequest          = ($isSandBox) ? 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' : 'https://ws.pagseguro.uol.com.br/v2/checkout/payment.html?code=';

$urlLigthbox                      = ($isSandBox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js';
 
$urlTransparenteSession           = ($isSandBox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions' : 'https://ws.pagseguro.uol.com.br/v2/sessions';

$urlTransparenteJs                = ($isSandBox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';

$urlPaymentTransparente           = ($isSandBox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions' : 'https://ws.pagseguro.uol.com.br/v2/transactions';

$urlnotification                  = ($isSandBox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications' : 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications';


return [
    // AMBIENTE DO PAGSEGURO NO CASO SANDBOX
    'envirorinment' => $envirorinment,
    // OS DADOS DE VENDEDOR QUE ESTÁ NO ARQUIVO ENV. ESSE DADOS DE VENDEDOR É USADO PARA TODA API
    'email' => env('PAGSEGURO_EMAIL'),
    'token' => env('PAGSEGURO_TOKEN'),

    // == PAGAMENTO PADRÃO == //
    // faz uma requição para está url, retorna um código.
    'url_checkout'                       => $urlCheckout,
    // depois de receber o código retorno o usuario para está url. COM O CÓDIGO. para efetuar o pedido.
    'url_redirect_after_request'         => $urlRedirectAfterRequest,
    // == FIM DO PAGAMENTO PADRÃO == //


    // == PAGAMENTO COM PAGSEGURO LIGTHBOX == //
    'url_ligthbox'                       => $urlLigthbox,
    // == FIM DO PAGAMENTO LIGTHBOX == //

    // == PAGAMENTO COM CHECKOUT TRANSPARENTE == //
    // url da sessão
    'url_transparente_session'           => $urlTransparenteSession,
    // url do ckecout transparente
    'url_transparente_js'                => $urlTransparenteJs,

    // == PAGAMENTO POR BOLETO == /
    'url_payment_transparente'           => $urlPaymentTransparente,
    
    // Para consultar uma notificação de transação
    'url_notification'                   => $urlnotification,

];

// para pegar o toke na produção
// preferencias e integração
// no arquivo .env está os dados de email e token.