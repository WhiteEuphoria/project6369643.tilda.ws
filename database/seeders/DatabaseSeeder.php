<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the main administrator
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@system.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'verification_status' => 'approved',
            'main_balance' => 100000,
        ]);
        // Create a demo client
        User::factory()->create([
            'name' => 'Test Client',
            'email' => 'client@demo.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'verification_status' => 'pending', // "Pending" status to test logic
            'main_balance' => 50000,
        ]);
    }
}
