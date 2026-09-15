@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">
    
    <div class="border-b border-gray-200 pb-5">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Status Pendaftaran</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau perkembangan proses rekrutmen Anda di sini.</p>
    </div>

    @if(!$application)
        <!-- Kondisi: Admin Telah Menghapus Data (Bisa Daftar Ulang) -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 text-center">
            <i class="fa-solid fa-folder-open text-4xl text-imersa-deep mb-4"></i>
            <h3 class="text-lg font-bold text-gray-800">Belum Ada Lamaran Aktif</h3>
            <p class="text-sm text-gray-600 mt-2 mb-4">Anda belum mengirimkan berkas atau data Anda sebelumnya telah dihapus oleh sistem. Silakan mendaftar kembali.</p>
            <a href="{{ route('lowongan.create') }}" class="inline-block bg-imersa-deep text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-imersa-gem transition-colors">
                Mulai Pendaftaran
            </a>
        </div>
    @else
        
        <!-- Notifikasi Web Jika Diterima -->
        @if($application->status === \App\Models\Application::STATUS_ACCEPTED)
        <div class="bg-green-50 border-2 border-green-200 rounded-2xl p-6 shadow-sm flex items-start gap-4">
            <div class="bg-green-500 text-white p-3 rounded-full flex-shrink-0">
                <i class="fa-solid fa-party-horn text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-extrabold text-green-800">Selamat! Anda Diterima</h3>
                <p class="text-sm text-green-700 mt-1">Lamaran Anda untuk posisi <strong>{{ $application->vacancy->title }}</strong> telah disetujui. Tim HR kami telah mengirimkan detail *onboarding* melalui email Anda. Silakan cek kotak masuk atau folder spam Anda.</p>
            </div>
        </div>
        @endif

        <!-- Notifikasi Web Jika Ditolak -->
        @if($application->status === \App\Models\Application::STATUS_REJECTED)
        <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-6 shadow-sm flex items-start gap-4">
            <div class="bg-red-500 text-white p-3 rounded-full flex-shrink-0">
                <i class="fa-solid fa-circle-xmark text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-extrabold text-red-800">Status: Belum Lolos Seleksi</h3>
                <p class="text-sm text-red-700 mt-1 mb-3">Mohon maaf, lamaran Anda tidak dapat dilanjutkan ke tahap berikutnya saat ini. Namun, jangan berkecil hati!</p>
                <a href="{{ route('lowongan.create') }}" class="text-xs font-bold text-white bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Coba Daftar Posisi Lain
                </a>
            </div>
        </div>
        @endif

        <!-- Timeline Status Terkunci -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 md:p-8 mt-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 bg-gray-100 text-gray-500 text-[10px] font-bold px-3 py-1 rounded-bl-lg">
                <i class="fa-solid fa-lock mr-1"></i> Data Terkunci
            </div>
            <h3 class="font-bold text-imersa-deep mb-6">Detail Posisi: {{ $application->vacancy->title }}</h3>
            
            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-200 before:to-transparent">
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-imersa-gem text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                    </div>
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-blue-50 p-4 rounded-xl shadow-sm">
                        <div class="flex items-center justify-between space-x-2 mb-1">
                            <div class="font-bold text-gray-800 text-sm">Status Saat Ini</div>
                            <time class="text-[10px] text-blue-500 font-bold">{{ $application->updated_at->format('d M, H:i') }}</time>
                        </div>
                        <div class="text-gray-600 text-xs">Posisi lamaran Anda saat ini berada di tahap: <strong class="text-imersa-deep uppercase">{{ $application->status }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection