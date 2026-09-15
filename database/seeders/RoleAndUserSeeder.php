<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan Cache Permissions dari Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Registrasi Role Baru ke Sistem
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $applicantRole = Role::firstOrCreate(['name' => 'applicant']);

        // 3. Buat Akun Institusi / HRD Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@imersa.co.id'],
            [
                'name' => 'HRD PT Imersa Solusi Teknologi',
                'password' => bcrypt('password123'),
            ]
        );
        $admin->syncRoles([$adminRole]);

        // 4. Buat Akun Utama Pelamar (Dummy Akun Pertama)
        $pelamar = User::firstOrCreate(
            ['email' => 'dimas@gmail.com'],
            [
                'name' => 'Dimas Nugroho',
                'password' => bcrypt('password123'),
            ]
        );
        $pelamar->syncRoles([$applicantRole]);

        $this->command->info('RoleAndUserSeeder Berhasil Dieksekusi: Akun Admin & Pelamar Siap Digunakan.');
    }
}