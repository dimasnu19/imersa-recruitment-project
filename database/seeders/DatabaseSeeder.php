<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil sub-seeder agar dieksekusi secara berurutan
        $this->call([
            RoleAndUserSeeder::class,
        ]);
        
        // 1. Reset cache permission bawaan paket Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Buat Role (Hak Akses) jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $applicantRole = Role::firstOrCreate(['name' => 'applicant']);

        // 3. Buat Akun Admin Utama
        $admin = User::firstOrCreate(
            ['email' => 'admin@imersa.co.id'],
            [
                'name' => 'HRD PT Imersa',
                'password' => bcrypt('password123') // Password default
            ]
        );
        // Berikan hak akses admin
        $admin->assignRole($adminRole);

        // 4. Buat Akun Pelamar Dummy untuk Pengujian
        $pelamar = User::firstOrCreate(
            ['email' => 'dimas@gmail.com'],
            [
                'name' => 'Dimas Nugroho',
                'password' => bcrypt('password123') // Password default
            ]
        );
        // Berikan hak akses pelamar
        $pelamar->assignRole($applicantRole);

        // Menampilkan pesan sukses di terminal
        $this->command->info('Berhasil! Akun Admin dan Pelamar telah dibuat beserta hak aksesnya.');
    }
}