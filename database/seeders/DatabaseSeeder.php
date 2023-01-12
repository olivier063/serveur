<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Message::factory(10)->create(); //ici on cree 10 messages aleatoires
        \App\Models\Message::factory()->create([
            'auteur' => 'Polo walter',
            'contenu' => 'ceci est un contenu',
        ], 
       );

       \App\Models\Annonces::factory(10)->create(); //ici on cree 10 annonces aleatoires
        \App\Models\Annonces::factory()->create([
            'auteur' => 'Polo',
            'user_id' => 1,
            'description' => 'ceci est un contenu d annonce',
            'prix' => 3.5
        ], 
       );

      


    }
}
