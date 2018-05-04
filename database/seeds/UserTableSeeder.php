<?php

use Illuminate\Database\Seeder;

// == Model User == //
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
        	'name'      => 'Walace Santana',
        	'email'     => 'walace.php@gmail.com',
        	'password'  =>  bcrypt('123456'),
        ]);
    }
}
