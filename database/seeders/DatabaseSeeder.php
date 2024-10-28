<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call(UsersTableSeeder::class);

        User::factory()->create([
            'name' => 'Hendri Arifin',
            'email' => 'arifin.hendri465@gmail.com',
        ]);
        
        User::factory()->create([
            'name' => 'Moh. Alifan',
            'email' => 'alifan@gmail.com',
        ]);
    }
}
