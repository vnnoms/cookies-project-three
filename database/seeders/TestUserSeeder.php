<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'vnnoms'],
            [
                'full_name' => 'callista',
                'password' => 'tAehyungi3!',
            ]
        );
    }
}