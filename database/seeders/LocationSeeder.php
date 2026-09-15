<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            // Yogyakarta (Pusat)
            ['city' => 'Yogyakarta (Pusat)', 'name' => 'Imersa x English Cafe Pusat (Timoho)'],
            ['city' => 'Yogyakarta (Pusat)', 'name' => 'Imersa x English Cafe UII (Joglo Joeara)'],
            ['city' => 'Yogyakarta (Pusat)', 'name' => 'Imersa x English Cafe UMY (Bumijo)'],
            ['city' => 'Yogyakarta (Pusat)', 'name' => 'Imersa x English Cafe Kota Gede'],
            
            // Solo
            ['city' => 'Solo', 'name' => 'Imersa x English Cafe UMS (Bento Kopi)'],
            ['city' => 'Solo', 'name' => 'Imersa x English Cafe UNS (Bento Kopi)'],
            
            // Bandung
            ['city' => 'Bandung', 'name' => 'Imersa x English Cafe UNPAD (Backspace Cafe)'],
            ['city' => 'Bandung', 'name' => 'Imersa x English Cafe ITB (Terminal Coffee)'],
            
            // Depok
            ['city' => 'Depok (UI)', 'name' => 'Imersa x English Cafe UI (JPG Cafe & Eatery)'],
            
            // Semarang
            ['city' => 'Semarang', 'name' => 'Imersa x English Cafe UNDIP (Bento Kopi Tembalang)'],
            ['city' => 'Semarang', 'name' => 'Imersa x English Cafe USM (Noms Kopi Gayamsari)'],
            ['city' => 'Semarang', 'name' => 'Imersa x English Cafe UNNES (Cue Kopi)'],
            
            // Malang
            ['city' => 'Malang', 'name' => 'Imersa x English Cafe UB (Kopi Siippp Toast Sutoyo)'],
            ['city' => 'Malang', 'name' => 'Imersa x English Cafe UIN (PISKIP)'],
            
            // Nganjuk
            ['city' => 'Nganjuk', 'name' => 'PT Imersa Solusi Teknologi (Jl. Mastrip 54)'],
            ['city' => 'Nganjuk', 'name' => 'PT Imersa Solusi Teknologi (Jl. Tangkis Baron)'],
            ['city' => 'Nganjuk', 'name' => 'Imersa Academy (Jl. Puntodewo 2)'],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(
                ['name' => $location['name']],
                ['city' => $location['city']]
            );
        }
    }
}