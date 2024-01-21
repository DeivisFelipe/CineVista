<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar um usuario admin 
        // Senha com hash
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'guerreirodosul01@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'admin' => true,
        ]);
    }
}
