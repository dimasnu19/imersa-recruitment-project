<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\InternshipVacancy;
use App\Models\Location;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    // ==========================================
    // BAGIAN PELAMAR (APPLICANT)
    // ==========================================

    public function create()
    {
        // Mengambil lamaran terakhir milik user
        $application = Application::where('user_id', Auth::id())->with('vacancy')->latest()->first();
        
        // REVISI: Halaman rekap ("applied_data") hanya ditampilkan jika user memiliki lamaran yang statusnya BUKAN Ditolak (Rejected)
        if ($application && $application->status !== Application::STATUS_REJECTED) {
            return view('applicant.applied_data', compact('application'));
        }

        // Jika belum pernah melamar ATAU lamaran sebelumnya sudah ditolak/dihapus, tampilkan form pendaftaran baru
        $vacancies = InternshipVacancy::where('is_active', true)->get();
        $locations = Location::all()->groupBy('city');

        return view('applicant.apply', compact('vacancies', 'locations'));
    }

    public function store(StoreApplicationRequest $request)
    {
        // REVISI: Validasi lamaran ganda hanya berlaku jika ada lamaran aktif yang statusnya BUKAN Ditolak (Rejected)
        $hasActiveApplication = Application::where('user_id', Auth::id())
            ->where('status', '!=', Application::STATUS_REJECTED)
            ->exists();

        if ($hasActiveApplication) {
            return redirect()->route('applicant.status')->with('error', 'Lamaran ganda terdeteksi. Anda memiliki pendaftaran yang sedang berjalan.');
        }

        try {
            $this->applicationService->storeApplication($request->validated(), $request->allFiles());
            return redirect()->route('applicant.status')->with('success', 'Pendaftaran berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function dashboard()
    {
        // Menggunakan latest()->first() agar dashboard otomatis menampilkan data dari lamaran terbaru pelamar
        $application = Application::where('user_id', Auth::id())->latest()->first();
        return view('applicant.dashboard', compact('application'));
    }

    public function status()
    {
        // Menggunakan latest()->first() agar halaman status otomatis menampilkan status dari lamaran terbaru pelamar
        $application = Application::where('user_id', Auth::id())->latest()->first();
        return view('applicant.status', compact('application'));
    }

    // ==========================================
    // BAGIAN ADMIN
    // ==========================================

    // 1. Menu Home (Statistik Keseluruhan)
    public function adminDashboard()
    {
        $stats = InternshipVacancy::withCount([
            'applications as total_applicants',
            'applications as accepted_count' => function ($query) { 
                $query->where('status', 'Accepted'); 
            },
            'applications as active_count' => function ($query) { 
                $query->whereIn('status', ['Applied', 'Validated']); 
            }
        ])->get();

        $totalApplications = Application::count();

        return view('admin.dashboard', compact('stats', 'totalApplications'));
    }

    // 2. Menu Kelola Seleksi (Kanban Eksklusif)
    public function adminSelection()
    {
        $applications = Application::with(['user', 'vacancy'])
            ->whereIn('status', [Application::STATUS_APPLIED, Application::STATUS_VALIDATED])
            ->get();
        
        $kanbanData = [
            'Lamaran Diterima' => $applications->where('status', Application::STATUS_APPLIED),
            'Validasi Data' => $applications->where('status', Application::STATUS_VALIDATED),
            'Hasil Akhir' => collect()
        ];
        
        return view('admin.selection', compact('kanbanData'));
    }

    // 3. Menampilkan Halaman Riwayat (Riwayat Akhir)
    public function adminHistory()
    {
        $accepted = Application::with(['user', 'vacancy'])
            ->where('status', Application::STATUS_ACCEPTED)
            ->latest()
            ->get();
            
        $rejected = Application::with(['user', 'vacancy'])
            ->where('status', Application::STATUS_REJECTED)
            ->latest()
            ->get();

        return view('admin.history', compact('accepted', 'rejected'));
    }

    // 4. Memperbarui status dengan respons JSON
    public function updateStatus(Request $request, Application $application)
    {
        $request->validate(['status' => 'required|string']);

        try {
            $application->transitionTo($request->status);

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Status berhasil diubah!']);
            }
            
            return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui.');
            
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // 5. Menghapus Riwayat Secara Permanen
    public function destroy(Application $application)
    {
        try {
            $files = ['profile_photo', 'cv', 'portfolio', 'recommendation_letter'];
            foreach ($files as $file) {
                if ($application->$file) {
                    Storage::delete($application->$file);
                }
            }

            $application->delete();
            return redirect()->back()->with('success', 'Data riwayat pelamar berhasil dihapus permanen.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}