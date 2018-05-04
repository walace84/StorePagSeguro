<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador controla os usuários de autenticação para o aplicativo e
    | redirecionando-os para a tela inicial. O controlador usa uma característica
    | para fornecer convenientemente a sua funcionalidade às suas aplicações.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redireciona para rota home
     *
     */
    protected $redirectTo = '/';

    /**
     * Crie uma nova instância de controlador
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
