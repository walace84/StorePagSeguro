<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// rota de request da api do pagseguro.
Route::post('pagseguro', 'Api\ApiPagSeguroController@request');
