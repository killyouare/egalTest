<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * @return void
     */
    public function run(): void
    {
        if (!User::where('email', 'user@user.com')->exists()) {
            User::factory()
                ->create([
                    'email' => 'user@user.com',
                    'password' => 'user',
                    'is_admin' => false
                ]);
        }

        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::factory()
                ->create([
                    'email' => 'admin@admin.com',
                    'password' => 'admin',
                    'is_admin' => true
                ]);
        }

        User::factory(10)->create();
    }
}
