<?php

namespace App\Http\Controllers;

use App\Models\InternshipVacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = InternshipVacancy::withCount('applications')->get();
        return view('admin.vacancies', compact('vacancies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', 
            'description' => 'required|string'
        ]);

        try {
            InternshipVacancy::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => true,
                'icon' => 'fa-briefcase', // Default icon
                'materi' => [], // Default empty array
                'quota' => 0    // Mencegah error jika database mewajibkan kolom quota
            ]);
            
            return redirect()->back()->with('success', 'Divisi baru berhasil ditambahkan ke Form Pendaftaran.');
            
        } catch (\Exception $e) {
            // Menangkap error database dan menampilkannya di layar (bukan Error 500)
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, InternshipVacancy $vacancy)
    {
        try {
            $vacancy->update([
                'title' => $request->title, 
                'is_active' => $request->is_active
            ]);
            return redirect()->back()->with('success', 'Pengaturan divisi diperbarui.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy(InternshipVacancy $vacancy)
    {
        if($vacancy->applications()->count() > 0) {
            return redirect()->back()->with('error', 'Divisi tidak bisa dihapus karena sudah ada pelamar.');
        }
        
        try {
            $vacancy->delete();
            return redirect()->back()->with('success', 'Divisi dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}