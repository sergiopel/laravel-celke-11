<?php

namespace Database\Seeders;

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
        if (!User::where('email', 'serpel@gmail.com')->first()) {
            User::create([
                'name' => 'Sergio',
                'email' => 'serpel@gmail.com',
                'password' => Hash::make('1234567S', ['rounds' => 12])
            ]);
        }
        if (!User::where('email', 'ana@gmail.com')->first()) {
            User::create([
                'name' => 'Ana',
                'email' => 'ana@gmail.com',
                'password' => Hash::make('1234567A', ['rounds' => 12])
            ]);
        }
        if (!User::where('email', 'paulo@gmail.com')->first()) {
            User::create([
                'name' => 'Paulo',
                'email' => 'paulo@gmail.com',
                'password' => Hash::make('1234567P', ['rounds' => 12])
            ]);
        }
        if (!User::where('email', 'joao@gmail.com')->first()) {
            User::create([
                'name' => 'João',
                'email' => 'joao@gmail.com',
                'password' => Hash::make('1234567J', ['rounds' => 12])
            ]);
        }
    }
}
