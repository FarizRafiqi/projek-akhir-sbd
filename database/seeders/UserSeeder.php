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
                "name" => "Admin",
                "email" => "admin@mediclo.com",
                "email_verified_at" => now(),
                "password" => bcrypt("admin123"),
                "remember_token" => Str::random(10),
                "role_id" => Role::find(1)->id,
                "phone_num" => "088211113333",
                "sex" => "male"
            ],
            [
                "name" => "Staf 1",
                "email" => "staf1@mediclo.com",
                "email_verified_at" => now(),
                "password" => bcrypt("rahasia123"),
                "remember_token" => Str::random(10),
                "role_id" => Role::find(3)->id,
                "phone_num" => "088244445555",
                "sex" => "male"
            ],
            [
                "name" => "Staf 2",
                "email" => "staf2@mediclo.com",
                "email_verified_at" => now(),
                "password" => bcrypt("rahasia223"),
                "remember_token" => Str::random(10),
                "role_id" => Role::find(3)->id,
                "phone_num" => "088266667777",
                "sex" => "female"
            ],
            [
                "name" => "Staf 3",
                "email" => "staf3@mediclo.com",
                "email_verified_at" => now(),
                "password" => bcrypt("rahasia323"),
                "remember_token" => Str::random(10),
                "role_id" => Role::find(3)->id,
                "phone_num" => "088288889999",
                "sex" => "female"
            ]
        ]);
    }
}
