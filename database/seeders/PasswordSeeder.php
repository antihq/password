<?php

namespace Database\Seeders;

use App\Models\Password;
use Illuminate\Database\Seeder;

class PasswordSeeder extends Seeder
{
    public function run(): void
    {
        Password::factory()->count(10)->create();
    }
}
