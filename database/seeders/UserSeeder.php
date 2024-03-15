<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ])->each(function ($user) {
            $user->addresses()->save(UserAddress::factory()->make());
        });
    }
}
