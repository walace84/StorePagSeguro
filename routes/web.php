<?php


// == ROTA DE AUTH == //
Auth::routes();



// GRUPO DE ROTAS DE AUTH
Route::group(['middleware' => 'auth'], function(){
	

/*
	ROTAS DO CART
*/
// middleware criado na pasta de middleware e nome especifico na Kernel.
Route::get('meio-pagamento', 'StoreController@methodPayment')->middleware('check.qtd.cart')->name('method.payment');
// faz a requisição para está rota. e da um returno do ID.do usuario.
Route::post('pagseguro-getcode','PagSeguroController@getCode')->name('pagseguro.code.tranparente');
Route::post('pagseguro-payment-billet', 'PagSeguroController@billet')->name('pagseguro.billet');


/*
	ROTA DO PERFIL
*/
// rota de perfil
Route::get('perfil', 'UserController@profile')->name('profile');
// Rota de update do perfil
Route::post('profile-update', 'UserController@profileUpdate')->name('profile.update');
// Rota da senha
Route::get('minha-senha','UserController@password')->name('password');
// Rota de update senha
Route::post('atualizar-senha','UserController@passwordUpdate')->name('password.update');
// ROTA DE LISTAGEM DOS PEDIDOS.
Route::get('meus-pedidos', 'UserController@myOrders')->name('my.orders');
// descrição dos produtos do pedido
Route::get('pedidos/{reference}', 'UserController@detailsOrder')->name('order.details');



// Rota para sair do sistema
Route::get('logout', 'UserController@logout')->name('logout');

});

// rota para remover um produto
Route::get('remove-cart/{id}', 'CartController@remove')->name('remove.cart');
// rota do id do produto, adiciona um produto pelo seu id
Route::get('add-cart/{id}', 'CartController@add')->name('add.cart');

// rota do carrinho
Route::get('carrinho', 'StoreController@cart')->name('cart');
// página inicial
Route::get('/', 'StoreController@index')->name('home');





// FOI CRIADO MIGRATE
// SEEDERS
// MODELS
// ALTERAÇÕES NO ARQUIVO ENV
// FOI CRIADO UM ARQUIVO NO CONFIG, PAGSEGURO




