<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de reinicialização de senha
    |--------------------------------------------------------------------------
    |
    | Este controlador é responsável pelo tratamento de e-mails de redefinição de senha e
    | inclui uma característica que auxilia no envio dessas notificações de
    | seu aplicativo para seus usuários. Sinta-se livre para explorar essa característica.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Crie uma nova instância de controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
