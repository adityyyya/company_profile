<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = New User();
        $user -> name = 'Administrator';
        $user -> email = 'admin@gmail.com';
        $user -> password = Hash::make('admin123');
        $user -> level = 'Admin';
        $user -> save();
    }
}
