<?php

namespace Database\Seeders;

use Stancl\Tenancy\Tenancy;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar um usuario admin 
        // Senha com hash=
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'guerreirodosul01@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'admin' => true,
        ]);
    }
}
