<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mediclo.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'),
                'remember_token' => Str::random(10),
                'role_id' => Role::find(1)->id,
            ],
            [
                'nama' => 'Staf 1',
                'username' => 'staf1',
                'email' => 'staf3@mediclo.com',
                'email_verified_at' => now(),
                'password' => bcrypt('rahasia123'),
                'remember_token' => Str::random(10),
                'role_id' => Role::find(3)->id,
            ],
            [
                'nama' => 'Staf 2',
                'username' => 'staf2',
                'email' => 'staf3@mediclo.com',
                'email_verified_at' => now(),
                'password' => bcrypt('rahasia223'),
                'remember_token' => Str::random(10),
                'role_id' => Role::find(3)->id,
            ],
            [
                'nama' => 'Staf 3',
                'username' => 'staf3',
                'email' => 'staf3@mediclo.com',
                'email_verified_at' => now(),
                'password' => bcrypt('rahasia323'),
                'remember_token' => Str::random(10),
                'role_id' => Role::find(3)->id,
            ]
        ]);
    }
}
