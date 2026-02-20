<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::create([
            'name'     => 'Digisoft Admin',
            'email'    => 'admin@digisoft.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Sample client
        User::create([
            'name'     => 'Test Client',
            'email'    => 'client@digisoft.com',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);
    }
}