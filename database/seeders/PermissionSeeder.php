<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            // User Management
            ["title" => "user_access"],
            ["title" => "user_create"],
            ["title" => "user_update"],
            ["title" => "user_delete"],
            ["title" => "user_edit"],
            ["title" => "user_show"],

            // Role Management
            ["title" => "role_access"],
            ["title" => "role_create"],
            ["title" => "role_update"],
            ["title" => "role_delete"],
            ["title" => "role_edit"],

            // Permission Management
            ["title" => "permission_access"],
            ["title" => "permission_create"],
            ["title" => "permission_update"],
            ["title" => "permission_delete"],
            ["title" => "permission_edit"],

            // Permission Role Management
            ["title" => "permission_role_access"],
            ["title" => "permission_role_create"],
            ["title" => "permission_role_update"],
            ["title" => "permission_role_delete"],
            ["title" => "permission_role_edit"],

            // Brand Management
            ["title" => "brand_access"],
            ["title" => "brand_create"],
            ["title" => "brand_update"],
            ["title" => "brand_delete"],
            ["title" => "brand_edit"],

            // Drug Management
            ["title" => "drug_access"],
            ["title" => "drug_create"],
            ["title" => "drug_update"],
            ["title" => "drug_delete"],
            ["title" => "drug_edit"],
            ["title" => "drug_show"],

            // Brand Type Management
            ["title" => "brand_type_access"],
            ["title" => "brand_type_create"],
            ["title" => "brand_type_update"],
            ["title" => "brand_type_delete"],
            ["title" => "brand_type_edit"],

            // Brand Form Management
            ["title" => "brand_form_access"],
            ["title" => "brand_form_create"],
            ["title" => "brand_form_update"],
            ["title" => "brand_form_delete"],
            ["title" => "brand_form_edit"],

            // Purchase Management
            ["title" => "purchase_access"],
            ["title" => "purchase_update"],
            ["title" => "purchase_edit"],
            ["title" => "purchase_show"],

            // Activity Management
            ["title" => "activity_log_access"],
            ["title" => "activity_log_update"],
            ["title" => "activity_log_edit"],
            ["title" => "activity_log_show"],
        ]);
    }
}
