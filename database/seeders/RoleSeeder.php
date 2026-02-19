<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'description' =>'This is an Adminstrator'
        ]);

        Role::create([
            'name' => 'Trainer',
            'description' =>'This is a Trainer'
        ]);

        Role::create([
            'name' => 'User',
            'description' =>'This is a normal User'
        ]);

        Role::create([
            'name' => 'Staff',
            'description' =>'This is a Staff'
        ]);
    }
}
