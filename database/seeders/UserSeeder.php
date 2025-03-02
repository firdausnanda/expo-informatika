<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dosen',
                'username' => 'dosen',
                'email' => 'dosen@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];

        
        foreach ($user as $value) {
            $user = User::create($value);
            $user->assignRole(RoleEnum::from($value['username']));
        }
    }
}
