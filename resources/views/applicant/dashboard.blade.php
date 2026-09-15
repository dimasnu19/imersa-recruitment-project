@extends('layouts.app')

@section('content')
<div class="space-y-12 pb-16 max-w-6xl mx-auto" x-data="{ open: false, selected: null, activeFaq: null }">
    
    <!-- 1. HERO SECTION DENGAN GRADIENT KHAS & SMART CTA -->
    <div class="relative overflow-hidden bg-gradient-to-r from-imersa-deep to-imersa-gem rounded-2xl p-8 md:p-12 text-white shadow-lg flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white border border-white/10 rounded text-[10px] font-bold uppercase tracking-widest mb-4 shadow-sm">
                Portal Rekrutmen
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-3 tracking-tight">
                Selamat Datang, {{ Auth::user()->name }}.
            </h1>
            <p class="text-imersa-light text-sm md:text-base leading-relaxed mb-8 opacity-90">
                Jelajahi peluang magang dan PKL di PT Imersa Solusi Teknologi. Bangun portofolio nyata, belajar langsung dari praktisi industri, dan jadilah bagian dari talenta digital masa depan.
            </p>
            
            @if($application)
                <a href="{{ route('applicant.status') }}" class="inline-flex items-center gap-2 bg-white text-imersa-deep px-6 py-3 rounded-lg text-sm font-bold shadow-md hover:bg-gray-50 transition-all">
                    <i class="fa-solid fa-chart-line"></i> Pantau Status Lamaran
                </a>
            @else
                <a href="{{ route('lowongan.create') }}" class="inline-flex items-center gap-2 bg-yellow-400 text-yellow-900 px-6 py-3 rounded-lg text-sm font-bold shadow-md hover:bg-yellow-300 transition-all animate-bounce">
                    <i class="fa-solid fa-paper-plane"></i> Mulai Pendaftaran
                </a>
            @endif
        </div>
        
        <!-- Ornamen Latar Belakang -->
        <div class="absolute top-0 right-0 w-80 h-80 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-imersa-deep/20 rounded-full -ml-20 -mb-20 blur-2xl"></div>
    </div>

    <!-- 2. KATALOG DIVISI -->
    <div>
        <div class="border-b border-gray-200 pb-4 mb-6">
            <h2 class="text-lg font-bold text-gray-900">Katalog Divisi & Kurikulum Magang</h2>
            <p class="text-sm text-gray-500 mt-1">Pilih peminatan yang sesuai dengan jurusan dan passion Anda.</p>
        </div>

        @php
            $divisi = [
                ['title' => 'Web Development', 'icon' => 'fa-code', 'desc' => 'Pengembangan website modern berbasis Laravel dan integrasi sistem backend.', 'materi' => ['Laravel (MVC Concept)', 'REST API Development', 'Database MySQL', 'Blade & Frontend Integration', 'Deployment Website']],
                ['title' => 'Mobile Apps', 'icon' => 'fa-mobile-screen', 'desc' => 'Pembuatan aplikasi mobile berbasis Android/iOS dengan teknologi Flutter.', 'materi' => ['Flutter Fundamentals', 'UI/UX Mobile Design', 'API Integration', 'State Management', 'Build & Release APK']],
                ['title' => 'Digital Marketing', 'icon' => 'fa-chart-line', 'desc' => 'Strategi pemasaran digital untuk meningkatkan visibilitas dan konversi brand.', 'materi' => ['SEO Optimization', 'Social Media Ads', 'Content Strategy', 'Google Analytics', 'Copywriting']],
                ['title' => 'Graphic Design', 'icon' => 'fa-pen-ruler', 'desc' => 'Pembuatan desain visual UI/UX dan kebutuhan konten branding perusahaan.', 'materi' => ['UI/UX Design', 'Figma Mastery', 'Brand Identity', 'Social Media Design', 'Design System']],
                ['title' => 'Network & IT Support', 'icon' => 'fa-server', 'desc' => 'Pengelolaan infrastruktur jaringan server dan maintenance sistem IT.', 'materi' => ['Konfigurasi Jaringan', 'Troubleshooting', 'Mikrotik Essentials', 'Server Maintenance', 'Security Dasar']],
                ['title' => 'Admin & Finance', 'icon' => 'fa-file-invoice', 'desc' => 'Pengelolaan administrasi perusahaan, pengarsipan, dan pembukuan finansial.', 'materi' => ['Manajemen Administrasi', 'Excel Advanced', 'Laporan Keuangan', 'Pengarsipan Data', 'Sistem Informasi']],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($divisi as $item)
            <div @click="open = true; selected = {{ json_encode($item) }}" class="cursor-pointer bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:border-imersa-deep hover:shadow-md transition-all group flex flex-col h-full relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-gray-50 rounded-bl-3xl -mr-6 -mt-6 group-hover:bg-blue-50 transition-colors"></div>
                
                <!-- Icon menggunakan warna brand -->
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mb-4 border border-blue-100 group-hover:bg-imersa-gem transition-colors">
                    <i class="fa-solid {{ $item['icon'] }} text-lg text-imersa-deep group-hover:text-white"></i>
                </div>
                
                <h3 class="font-bold text-gray-900 mb-2 group-hover:text-imersa-deep transition-colors">{{ $item['title'] }}</h3>
                <p class="text-xs text-gray-500 leading-relaxed mb-4 flex-1">{{ $item['desc'] }}</p>
                <div class="text-[10px] font-bold uppercase tracking-wider text-imersa-gem flex items-center mt-auto">
                    Cek Silabus <i class="fa-solid fa-arrow-right ml-1.5 transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 3. ALUR & FAQ -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        
        <!-- Alur Rekrutmen -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <h2 class="text-sm font-bold text-imersa-deep uppercase tracking-wider mb-6 flex items-center"><i class="fa-solid fa-diagram-project text-gray-400 mr-2"></i> Proses Rekrutmen</h2>
            <div class="relative border-l border-gray-200 ml-2 space-y-6">
                <div class="relative pl-6">
                    <div class="absolute w-2.5 h-2.5 bg-gray-300 rounded-full -left-[5px] top-1.5"></div>
                    <h4 class="font-bold text-gray-800 text-sm">1. Submit Lamaran</h4>
                    <p class="text-xs text-gray-500 mt-1">Mengisi formulir melalui portal dan mengunggah CV.</p>
                </div>
                <div class="relative pl-6">
                    <div class="absolute w-2.5 h-2.5 bg-gray-300 rounded-full -left-[5px] top-1.5"></div>
                    <h4 class="font-bold text-gray-800 text-sm">2. Validasi & Review</h4>
                    <p class="text-xs text-gray-500 mt-1">HRD memverifikasi kesesuaian data dan kuota divisi.</p>
                </div>
                <div class="relative pl-6">
                    <div class="absolute w-2.5 h-2.5 bg-gray-300 rounded-full -left-[5px] top-1.5"></div>
                    <h4 class="font-bold text-gray-800 text-sm">3. Notifikasi Email</h4>
                    <p class="text-xs text-gray-500 mt-1">Hasil seleksi akan dikirim resmi melalui Email pendaftar.</p>
                </div>
                <div class="relative pl-6">
                    <div class="absolute w-2.5 h-2.5 bg-imersa-gem rounded-full -left-[5px] top-1.5 ring-4 ring-blue-50"></div>
                    <h4 class="font-bold text-imersa-deep text-sm">4. Onboarding</h4>
                    <p class="text-xs text-gray-500 mt-1">Penyambutan, briefing teknis, dan awal masa magang.</p>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <h2 class="text-sm font-bold text-imersa-deep uppercase tracking-wider mb-6 flex items-center"><i class="fa-regular fa-circle-question text-gray-400 mr-2"></i> FAQ & Bantuan</h2>
            <div class="space-y-3">
                @php
                    $faqs = [
                        1 => ['q' => 'Berapa lama proses seleksi memakan waktu?', 'a' => 'Tim HRD akan memproses validasi dalam rentang waktu 3-5 hari kerja.'],
                        2 => ['q' => 'Apakah surat pengantar wajib saat mendaftar?', 'a' => 'Opsional. Namun, surat pengantar fisik wajib dibawa saat hari pertama magang jika diterima.'],
                        3 => ['q' => 'Apakah program ini dipungut biaya?', 'a' => 'Tidak. Seluruh proses seleksi dan pelaksanaan magang di Imersa 100% bebas biaya.'],
                    ];
                @endphp
                
                @foreach($faqs as $id => $faq)
                <div class="border border-gray-100 rounded-lg overflow-hidden bg-gray-50/50">
                    <button @click="activeFaq = activeFaq === {{ $id }} ? null : {{ $id }}" class="w-full flex justify-between items-center p-3.5 text-left font-semibold text-gray-800 hover:bg-gray-100 transition-colors text-sm">
                        <span>{{ $faq['q'] }}</span>
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200" :class="activeFaq === {{ $id }} ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="activeFaq === {{ $id }}" x-collapse class="px-3.5 pb-3.5 text-xs text-gray-600 border-t border-gray-100 pt-2.5">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- MODAL KURIKULUM (Gradient Header Dikembalikan) -->
    <div x-show="open" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center z-[100] p-4" style="display: none;" x-transition.opacity>
        <div @click.away="open = false" class="bg-white rounded-xl overflow-hidden max-w-md w-full shadow-2xl">
            <div class="bg-gradient-to-r from-imersa-deep to-imersa-gem p-5 text-white flex justify-between items-center relative">
                <div class="flex items-center gap-3 relative z-10">
                    <div class="w-8 h-8 bg-white/20 rounded flex items-center justify-center"><i class="fa-solid text-sm" :class="selected?.icon"></i></div>
                    <h2 class="text-base font-bold" x-text="selected?.title"></h2>
                </div>
                <button @click="open = false" class="hover:text-gray-200 transition-colors relative z-10"><i class="fa-solid fa-xmark text-lg"></i></button>
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-10 -mt-10 blur-xl"></div>
            </div>
            <div class="p-6">
                <h3 class="text-[10px] font-bold text-gray-400 mb-3 uppercase tracking-widest">Silabus Pembelajaran</h3>
                <div class="space-y-2 mb-6">
                    <template x-for="m in selected?.materi">
                        <div class="flex items-start gap-2.5 text-sm text-gray-700 p-2 rounded hover:bg-blue-50 border border-transparent hover:border-blue-100 transition-colors">
                            <i class="fa-solid fa-check text-imersa-gem mt-0.5 text-xs"></i> <span x-text="m"></span>
                        </div>
                    </template>
                </div>
                <button @click="open = false" class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">Tutup Jendela</button>
            </div>
        </div>
    </div>
</div>
@endsection