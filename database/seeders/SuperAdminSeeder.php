<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Krzysztof',
            'surname' => 'Motylewski',
            'phone' => '604470021',
            'email' => 'k.motylewski@dks.pl',
            'password' => Hash::make('1q2w3e4r5t')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'admin',
            'surname' => '',
            'phone' => '',
            'email' => 'a@dks.pl',
            'password' => Hash::make('a12345')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'product manager',
            'surname' => '',
            'phone' => '',
            'email' => 'pm@dks.pl',
            'password' => Hash::make('pm12345')
        ]);
        $productManager->assignRole('Product Manager');

    }
}
