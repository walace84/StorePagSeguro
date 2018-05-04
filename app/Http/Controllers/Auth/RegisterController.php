<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de registro
    |--------------------------------------------------------------------------
    |
    | Este controlador controla o registro de novos usuários, bem como seus
    | validação e criação. Por padrão, este controlador usa uma característica para
    | forneça esta funcionalidade sem exigir nenhum código adicional.
    |
    */

    use RegistersUsers;

    /**
     * Onde redirecionar os usuários após o registro.
     */
    protected $redirectTo = '/';
    // == INSTANCIA DA MODEL DE USER == //
    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        // == INSTANCIA DA MODEL DE USER == //
        $this->user = $user;

        $this->middleware('guest');
    }

    /**
     * Obtenha um validador para uma solicitação de registro recebida.
     * PEGA AS REGRAS DE VALIDAÇÃO E TRAS PARA ESTE METODO.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->user->rules());
    }

    /**
     * Crie uma nova instância de usuário após um registro válido.
     */
    protected function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
}
