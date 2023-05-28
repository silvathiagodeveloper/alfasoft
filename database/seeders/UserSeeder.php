<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'tenant_id' => 1,
                'name' => 'admin',
                'email' => 'admin@alfasoft.com.br',
                'email_verified_at' => now(),
                'password' => bcrypt('123456')
            ]
        );
    }
}
