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
        if (!User::isExists('email', 'user@user.com')) {
            User::factory()
                ->create([
                    'email' => 'user@user.com',
                ]);
        }

        if (!User::isExists('email', 'admin@admin.com')) {
            User::factory()
                ->create([
                    'email' => 'admin@admin.com',
                    'password' => 'admin'
                ]);
        }

        User::factory(10);
    }
}