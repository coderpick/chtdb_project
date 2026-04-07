<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@chtdb.gov.bd'],
            [
                'name' => 'CHTDB Administrator',
                'password' => Hash::make('Admin@123456'), // Change in production!
                'role' => 'admin',
            ]
        );
    }
}
