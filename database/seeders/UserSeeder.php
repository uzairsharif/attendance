<?php

namespace Uzair3\Attendance\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            User::create([
                'name' => 'admin',
                'department_id' => '1',
                'role' => 'admin',
                'status' => 'active',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]);
            User::create([
                'name' => 'Uzair',
                'department_id' => '1',
                'role' => 'user',
                'status' => 'active',
                'email' => 'uzair@uzair.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]);
        // User::factory()->count(10)->create();
    }
}
