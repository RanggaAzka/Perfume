<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Creates the default administrator account.
     *
     * NOTE: These credentials are for LOCAL DEVELOPMENT ONLY.
     * Change the password (or delete this seeder's effect) before deploying to production.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmeil.com'],
            [
                'name' => 'Brand Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
