<?php

use Illuminate\Database\Seeder;

// == Model de Produto == //
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Como estamos criando os produtos com o create,
     * precisamos da permissão da model para os campos
     * a ser criados.
     * não esquecer de fazer o apontamento no DatabaseSedder.
     */
    public function run()
    {
        Product::create([

        	'name' => 'DREAMS',
        	'description' => 'Filme DREAMS com o ator desconlhecido.',
        	'price' => 10.6,
        	'image' => 'filme1.jpg',
        ]);

          Product::create([

        	'name' => 'Os Intocavéis',
        	'description' => 'Filme ganhador de 3 oscar e 2 laranjas.',
        	'price' => 8.2,
        	'image' => 'filme2.jpg',
        ]);

        Product::create([

        	'name' => 'O preço do manhã',
        	'description' => 'Filme estrelado com Justin Timberlan',
        	'price' => 15.7,
        	'image' => 'filme1.jpg',
        ]); 

             Product::create([

        	'name' => 'Sonhos',
        	'description' => 'Filme Sonhos com o ator desconlhecido.',
        	'price' => 10.6,
        	'image' => 'filme1.jpg',
        ]);

          Product::create([

        	'name' => 'Os implacaveis',
        	'description' => 'Filme ganhador de 3 oscar e 2 laranjas.',
        	'price' => 8.2,
        	'image' => 'filme2.jpg',
        ]);

        Product::create([

        	'name' => 'O preço do hoje',
        	'description' => 'Filme estrelado com Justin Timberlan',
        	'price' => 15.7,
        	'image' => 'filme1.jpg',
        ]); 

             Product::create([

        	'name' => 'Delirios',
        	'description' => 'Filme DREAMS com o ator desconlhecido.',
        	'price' => 10.6,
        	'image' => 'filme1.jpg',
        ]);

          Product::create([

        	'name' => 'Os canalhas',
        	'description' => 'Filme ganhador de 3 oscar e 2 laranjas.',
        	'price' => 8.2,
        	'image' => 'filme2.jpg',
        ]);

        Product::create([

        	'name' => 'O preço de agora',
        	'description' => 'Filme estrelado com Justin Timberlan',
        	'price' => 15.7,
        	'image' => 'filme1.jpg',
        ]); 

             Product::create([

        	'name' => 'Pesadelo',
        	'description' => 'Filme DREAMS com o ator desconlhecido.',
        	'price' => 10.6,
        	'image' => 'filme1.jpg',
        ]);

          Product::create([

        	'name' => 'Os vagabudos',
        	'description' => 'Filme ganhador de 3 oscar e 2 laranjas.',
        	'price' => 8.2,
        	'image' => 'filme2.jpg',
        ]);

        Product::create([

        	'name' => 'O cara',
        	'description' => 'Filme estrelado com Justin Timberlan',
        	'price' => 15.7,
        	'image' => 'filme1.jpg',
        ]);  
    }
}
