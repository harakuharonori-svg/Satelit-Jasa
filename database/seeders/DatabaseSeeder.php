<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin SatelitJasa',
            'email' => 'admin@satelitjasa.com',
            'password' => Hash::make('admin123'),
            'telepon' => '081234567890',
            'bio' => 'Administrator SatelitJasa',
            'role' => 'ADMIN'
        ]);
    }
}
