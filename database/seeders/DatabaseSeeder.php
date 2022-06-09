<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(100)->create();
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(DrugTypeSeeder::class);
        $this->call(DrugFormSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(DrugSeeder::class);
        $this->call(UserSeeder::class);
    }
}
