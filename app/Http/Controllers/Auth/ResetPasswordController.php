<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de reinicialização de senha
    |--------------------------------------------------------------------------
    |
    | Este controlador é responsável pelo tratamento de pedidos de redefinição de senha
    | e usa uma característica simples para incluir esse comportamento. Você está livre para
    | explore essa característica e substitua todos os métodos que você deseja ajustar.
    |
    */

    use ResetsPasswords;

    /**
     * Onde redirecionar os usuários depois de redefinir sua senha.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Crie uma nova instância de controlador
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
