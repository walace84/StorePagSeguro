<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Execução da classe 
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(ProductTableSeeder::class);
    }
}
