<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Imersa Solusi Teknologi - E-Recruitment</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        'imersa-deep': '#004B8F',
                        'imersa-gem': '#00A3E0',
                        'imersa-light': '#B2DFFD',
                        'imersa-bg': '#F8FAFC',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-imersa-bg font-sans text-gray-800 antialiased" x-data="{ expanded: true, mobileOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        @auth
        <div x-show="mobileOpen" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900/50 lg:hidden backdrop-blur-sm" @click="mobileOpen = false" x-cloak></div>

        <aside :class="expanded ? 'w-64' : 'w-20'" 
            class="fixed inset-y-0 left-0 z-30 bg-white border-r border-gray-100 transition-all duration-300 ease-in-out flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)] overflow-hidden">
            
            <div @click="expanded = !expanded" 
                 class="flex items-center h-24 border-b border-gray-50 flex-shrink-0 cursor-pointer hover:bg-gray-50 transition-colors duration-300 px-3 relative overflow-hidden">
                <div :class="expanded ? 'left-3' : 'left-1/2 -translate-x-1/2'" class="absolute w-14 h-10 flex items-center justify-center transition-all duration-300 ease-in-out">
                    <img src="{{ asset('images/imersa.png') }}" alt="Logo" class="h-9 w-auto object-contain">
                </div>
                <h1 x-show="expanded" x-transition.opacity.duration.200ms class="pl-16 text-2xl font-black text-imersa-deep tracking-tight whitespace-nowrap">Imersa</h1>
            </div>

            <nav class="flex-1 py-6 overflow-y-auto overflow-x-hidden custom-scrollbar px-3 space-y-1">
                
                <div class="h-6 mb-2 overflow-hidden relative w-full">
                    <p x-show="expanded" x-transition.opacity.duration.200ms class="absolute left-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Menu Utama</p>
                    <p x-show="!expanded" x-transition.opacity.duration.200ms class="absolute left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-400 uppercase tracking-widest"><i class="fa-solid fa-minus"></i></p>
                </div>

                @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-chart-pie text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Dashboard Statistik</span>
                    </a>
                    
                    <a href="{{ route('admin.selection') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.selection') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-layer-group text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Kelola Seleksi</span>
                    </a>
                    
                    <a href="{{ route('admin.history') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.history') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-clock-rotate-left text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Riwayat Final</span>
                    </a>
                    
                    <a href="{{ route('admin.vacancies.index') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.vacancies.index') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-sliders text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Pengaturan Form</span>
                    </a>

                    <a href="{{ route('admin.locations.index') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('admin.locations.index') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-map-location-dot text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Kelola Lokasi</span>
                    </a>
                @else
                    <a href="{{ route('applicant.dashboard') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('applicant.dashboard') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-compass text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Katalog Divisi</span>
                    </a>
                    
                    <a href="{{ route('lowongan.create') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('lowongan.create') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-file-signature text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Form Pendaftaran</span>
                    </a>
                    
                    <a href="{{ route('applicant.status') }}" class="flex items-center h-12 rounded-xl text-sm font-bold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('applicant.status') ? 'bg-gradient-to-r from-imersa-deep to-imersa-gem text-white shadow-md shadow-blue-200/50' : 'text-gray-500 hover:bg-blue-50 hover:text-imersa-deep' }}">
                        <div class="absolute left-0 w-14 h-12 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-satellite-dish text-lg"></i>
                        </div>
                        <span x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 whitespace-nowrap">Status Lamaran</span>
                    </a>
                @endrole
            </nav>

            <div class="mb-6 mt-auto px-3">
                <div :class="expanded ? 'bg-gray-50 border border-gray-100 p-3 rounded-2xl' : 'bg-transparent border-transparent p-0'" class="transition-all duration-300 overflow-hidden flex flex-col gap-3">
                    
                    <div class="flex items-center h-10 relative w-full">
                        <div :class="expanded ? 'left-0' : 'left-1/2 -translate-x-1/2'" class="absolute top-0 w-10 h-10 rounded-xl bg-gradient-to-tr from-imersa-deep to-imersa-gem flex items-center justify-center text-white font-bold shadow-sm transition-all duration-300 ease-in-out z-10">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        
                        <div x-show="expanded" x-transition.opacity.duration.200ms class="pl-14 w-full overflow-hidden whitespace-nowrap">
                            <p class="text-sm font-bold text-gray-800 truncate block w-full">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ Auth::user()->getRoleNames()->first() ?? 'Pelamar' }}</p> 
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" x-show="expanded" x-transition.opacity.duration.200ms class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-red-600 bg-white border border-red-100 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm whitespace-nowrap">
                            <i class="fa-solid fa-power-off text-sm"></i>
                            <span>Keluar Akun</span>
                        </button>
                    </form>
                    
                </div>
            </div>
        </aside>
        @endauth

        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out"
             @auth :class="expanded ? 'lg:pl-64' : 'lg:pl-20'" @endauth>
            
            @auth
            <header class="h-24 bg-white/60 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-6 lg:px-10 z-10 sticky top-0 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <button @click="mobileOpen = true" class="lg:hidden w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:text-imersa-deep shadow-sm focus:outline-none transition-colors">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                    
                    <div>
                        @php
                            $hour = now()->format('H');
                            $sapaan = ($hour < 12) ? 'Pagi' : (($hour < 15) ? 'Siang' : (($hour < 18) ? 'Sore' : 'Malam'));
                        @endphp
                        <h2 class="font-bold text-gray-800 text-lg hidden sm:block">Selamat {{ $sapaan }}, {{ explode(' ', Auth::user()->name)[0] }}!</h2>
                        <p class="text-xs text-gray-400 hidden sm:block">Semoga harimu produktif dan menyenangkan.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-white border border-gray-100 px-4 py-2 rounded-xl text-xs font-bold text-gray-500 shadow-sm flex items-center gap-2">
                        <i class="fa-regular fa-calendar text-imersa-gem"></i> 
                        <span class="hidden sm:inline">{{ now()->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </header>
            @endauth

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-imersa-bg p-4 sm:p-8 lg:p-10 relative custom-scrollbar">
                @yield('content')
            </main>

        </div>
    </div>

    <div x-data="{ show: false, message: '', type: 'success' }" 
         x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => { show = false }, 4000)"
         class="fixed bottom-10 right-10 z-[100] flex flex-col gap-3 pointer-events-none" x-cloak>
        
        @if(session('success'))
            <div x-data="{ showToast: true }" x-show="showToast" x-init="setTimeout(() => showToast = false, 4000)" 
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-10"
                 class="bg-gray-900 text-white px-6 py-4 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] flex items-center gap-3 min-w-[300px] pointer-events-auto border border-gray-700">
                <i class="fa-solid fa-circle-check text-green-400 text-xl drop-shadow-md"></i>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ showToast: true }" x-show="showToast" x-init="setTimeout(() => showToast = false, 5000)"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-10"
                 class="bg-white border-2 border-red-100 text-red-700 px-6 py-4 rounded-2xl shadow-[0_10px_40px_rgba(239,68,68,0.15)] flex items-center gap-3 min-w-[300px] pointer-events-auto">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
                <p class="font-bold text-sm">{{ session('error') }}</p>
            </div>
        @endif
    </div>

</body>
</html>