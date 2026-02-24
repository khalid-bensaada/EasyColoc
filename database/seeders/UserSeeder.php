<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Colocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Owner
        $owner = User::create([
            'name' => 'Owner User',
            'email' => 'owner@test.com',
            'password' => Hash::make('123456')
        ]);

        // Colocation
        $colocation = Colocation::create([
            'name' => 'Test House',
            'status' => 'active',
            'owner_id' => $owner->id
        ]);

        $colocation->users()->attach($owner->id, [
            'role' => 'owner',
            'joined_at' => now()
        ]);

        // Users list (fixed data)
        $usersData = [
            ['name' => 'User One', 'email' => 'user1@test.com'],
            ['name' => 'User Two', 'email' => 'user2@test.com'],
            ['name' => 'User Three', 'email' => 'user3@test.com'],
            ['name' => 'User Four', 'email' => 'user4@test.com'],
            ['name' => 'User Five', 'email' => 'user5@test.com'],
            ['name' => 'User Six', 'email' => 'user6@test.com'],
            ['name' => 'User Seven', 'email' => 'user7@test.com'],
            ['name' => 'User Eight', 'email' => 'user8@test.com'],
            ['name' => 'User Nine', 'email' => 'user9@test.com'],
            ['name' => 'User Ten', 'email' => 'user10@test.com'],
        ];

        foreach ($usersData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('123456')
            ]);

            $colocation->users()->attach($user->id, [
                'role' => 'member',
                'joined_at' => now()
            ]);
        }
    }
}
