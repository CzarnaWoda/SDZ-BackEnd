<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
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
        $this->call([
            CustomerSeeder::class,
            PetSeeder::class,
            RoleSeeder::class,
        ]);
            // Tworzenie użytkowników
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            // Pobieranie roli "user"
            $roleUser = Role::where('name', 'admin')->first();


            // Przypisanie roli "user" do użytkownika
            $user->roles()->attach($roleUser);



    }
}
