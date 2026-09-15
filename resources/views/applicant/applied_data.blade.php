@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 pb-12">
    <div class="border-b border-gray-200 pb-5">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Berkas Lamaran Anda</h1>
        <p class="text-sm text-gray-500 mt-1">Data ini telah diarsipkan secara permanen dan dalam tahap peninjauan HRD.</p>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <!-- Dikembalikan ke Gradient Imersa -->
        <div class="bg-gradient-to-r from-imersa-deep to-imersa-gem px-6 py-4 flex justify-between items-center text-white">
            <h3 class="font-bold text-sm flex items-center">
                <i class="fa-regular fa-address-card mr-2"></i> Rekapitulasi Data Diri
            </h3>
            <span class="bg-white/20 backdrop-blur-sm border border-white/10 px-3 py-1 rounded-md text-[10px] font-bold text-white uppercase tracking-widest flex items-center gap-1.5 shadow-sm">
                <i class="fa-solid fa-lock"></i> Terkunci
            </span>
        </div>
        
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-28 h-28 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0 border-2 border-imersa-light shadow-sm">
                    <img src="{{ asset('storage/' . $application->profile_photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-8 flex-1">
                    
                    <!-- REVISI: Bagian ini dibagi dua untuk Posisi dan Lokasi -->
                    <div class="md:col-span-2 border-b border-gray-100 pb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-imersa-gem font-bold mb-1">Posisi Magang Dipilih</p>
                            <p class="text-lg font-black text-gray-900">{{ $application->vacancy->title }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-imersa-gem font-bold mb-1">Sistem & Lokasi Penempatan</p>
                            <p class="text-sm font-bold text-imersa-deep flex items-center">
                                <i class="fa-solid fa-location-dot mr-2 text-gray-400"></i> 
                                {{ $application->location ?? 'Belum memilih lokasi' }} 
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-gray-900 text-sm">{{ $application->full_name ?? $application->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Kontak (Email & WA)</p>
                        <p class="font-semibold text-gray-900 text-sm">{{ $application->email }} <br> <span class="text-gray-600">{{ $application->phone }}</span></p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Gender & Tanggal Lahir</p>
                        <p class="font-semibold text-gray-900 text-sm">{{ $application->gender }} <br> <span class="text-gray-600">{{ \Carbon\Carbon::parse($application->birth_date)->format('d F Y') }}</span></p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Sumber Informasi</p>
                        <p class="font-semibold text-gray-900 text-sm">{{ $application->source }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Institusi & Program Studi</p>
                        <p class="font-semibold text-gray-900 text-sm bg-gray-50 p-3 rounded-md border border-gray-100">{{ $application->institution }} <span class="text-gray-500 font-normal">- {{ $application->major }}</span></p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Alamat Domisili</p>
                        <p class="font-semibold text-gray-900 text-sm bg-gray-50 p-3 rounded-md border border-gray-100">{{ $application->address }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Motivasi Bergabung</p>
                        <p class="text-sm text-gray-700 leading-relaxed italic bg-gray-50 p-4 rounded-md border border-gray-100">"{{ $application->motivation }}"</p>
                    </div>
                    
                    <div class="md:col-span-2 pt-4 border-t border-gray-100 mt-2">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-3">Dokumen Terlampir</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="inline-flex items-center bg-blue-50 text-imersa-deep border border-blue-100 px-4 py-2 rounded-lg text-xs font-bold hover:bg-imersa-gem hover:text-white transition-colors">
                                <i class="fa-solid fa-file-pdf mr-2 text-lg"></i> File CV
                            </a>
                            
                            @if($application->portfolio)
                            <a href="{{ asset('storage/' . $application->portfolio) }}" target="_blank" class="inline-flex items-center bg-purple-50 text-purple-700 border border-purple-100 px-4 py-2 rounded-lg text-xs font-bold hover:bg-purple-600 hover:text-white transition-colors">
                                <i class="fa-solid fa-briefcase mr-2 text-lg"></i> Portofolio
                            </a>
                            @endif

                            @if($application->recommendation_letter)
                            <a href="{{ asset('storage/' . $application->recommendation_letter) }}" target="_blank" class="inline-flex items-center bg-green-50 text-green-700 border border-green-100 px-4 py-2 rounded-lg text-xs font-bold hover:bg-green-600 hover:text-white transition-colors">
                                <i class="fa-solid fa-file-signature mr-2 text-lg"></i> Surat Pengantar
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection