<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Survey;
use App\Models\Session;
use App\Models\Remark;
use App\Models\Vote;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        
        Survey::factory(10)->create();
        // Session::factory(20)->create();
        // Remark::factory(50)->create();
        // Vote::factory(50)->create();
    }
}
