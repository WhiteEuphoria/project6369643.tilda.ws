<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'root@system.com'], // Lookup condition
            [
                'name' => 'Root Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'main_balance' => 0,
                'verification_status' => 'approved',
                'email_verified_at' => now(),
            ]
        );
    }
}
