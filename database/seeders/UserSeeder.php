<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@latiseducation.id',
                'role' => 'admin',
                'password' => Hash::make('admin')
            ],
        ];

        // Menyimpan data ke dalam tabel users
        foreach ($users as $key => $val) {
            User::create($val);
        }
    }
}
