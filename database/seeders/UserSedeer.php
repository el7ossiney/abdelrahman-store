<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name' =>'elhossiney',
            'email' =>'elhosyny87@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' =>'01125322212'
        ]);
    }
}
