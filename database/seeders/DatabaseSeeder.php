<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Seed roles
         Role::factory()->create([
             'name' => 'admin'
         ]);
         Role::factory()->create([
             'name' => 'lead'
         ]);
         Role::factory()->create([
             'name' => 'employee'
         ]);
    }
}
