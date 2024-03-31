<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'LOLO',
            'email' => 'gr2002@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $user->roles()->attach([1, 3]);

        $user2 = User::create([
            'name' => 'LOLO1212',
            'email' => 'gr202@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $user2->roles()->attach([2]);

        // $user = User::factory()
        //             ->create();
                
        // User::factory()->create([
        //     'email' => 'fefef@200.gmail.com',
        // ]);
    }

}
