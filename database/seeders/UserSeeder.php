<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name'      => 'IT Support',
            'username'  => 'administrator',
            'email'     => 'it@bprbangunarta.co.id',
            'password'  => 'admin123*'
        ]);

        $user->assignRole('Administrator');
    }
}
