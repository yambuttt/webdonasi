<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        $admin = \App\Models\User::create([
            'name' => 'Admin Pedulia',
            'email' => 'admin@pedulia.com',
            'password' => Hash::make('Kontolbabi123'),
            'role' => 'admin',
        ]);

        // Regular Donor
        \App\Models\User::create([
            'name' => 'Donatur Baik',
            'email' => 'donatur@bisakita.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);



        // Seed default payment configurations
        \App\Models\Setting::set('qris_image', '/images/qris.png');
        \App\Models\Setting::set('bank_name', 'NOBU BANK');
        \App\Models\Setting::set('bank_account_number', '1031-0988-1234');
        \App\Models\Setting::set('bank_account_name', 'Yayasan Bisa Kita');
        \App\Models\Setting::set('whatsapp_number', '6281234567890');
    }
}
