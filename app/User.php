<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * os campos que podem ser preenchido do user.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'cpf', 'birth_date', 'street', 'number', 'complement','district', 'postal_code', 'city', 'state', 'country', 'area_code', 'phone'];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // == VALIDAÇÃO DOS CAMPOS DE FORMULÁRIO == //
    public function rules()
    {
        return [
            'name'          => 'required|string|min:3|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'cpf'           => 'required|unique:users',
            'birth_date'    => 'required',
            'street'        => 'required',
            'number'        => 'integer|required',
            'complement'    => 'max:200',
            'district'      => 'max:200',
            'postal_code'   => 'integer|required',
            'city'          => 'required',
            'state'         => 'required',
            'country'       => 'required',
            'area_code'     => 'integer|required',
            'phone'         => 'required|integer',
        ];
    }

    // VALIDAÇÃO DO UPDATE PROFILE
    // pega os dados acima e retira os que não iremos precisar.
    public function rulesUpdateProfile()
    {
        $rules = $this->rules();

        unset($rules['password']);
        unset($rules['cpf']);
        unset($rules['email']);

        return $rules;
    }

    // VALIDAÇÃO DA SENHA
    public function rulesPassword()
    {
        return [
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    // METODO DE ATUALIZAR A SENHA
    public function updatePassword($newPassword)
    {
        $newPassword = bcrypt($newPassword);

        return $this->update([
            'password' => $newPassword,
        ]);
    }

    // == METODO DE ATUALIZAR O PERFIL == //
    public function profileUpdate(array $data)
    {
        return $this->update($data);
    }

}
