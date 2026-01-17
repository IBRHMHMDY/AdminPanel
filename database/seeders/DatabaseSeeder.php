<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@0000'), // كلمة المرور: password
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'User01',
            'email' => 'user01@user.com',
            'password' => bcrypt('00000000'), // كلمة المرور: password
            'role' => 'user',
        ]);
        User::factory()->create([
            'name' => 'User02',
            'email' => 'user02@user.com',
            'password' => bcrypt('11111111'), // كلمة المرور: password
            'role' => 'user',
        ]);
    }
}
