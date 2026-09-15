@extends('layouts.app')

@section('content')
<div class="space-y-6 pb-12" x-data="{ tab: 'accepted', openModal: null }">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Riwayat Keputusan</h1>
            <p class="text-sm text-gray-500 mt-1">Arsip data pelamar yang disetujui dan ditolak.</p>
        </div>
        <a href="{{ route('admin.export') }}" class="inline-flex items-center bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-semibold transition-all shadow-sm">
            <i class="fa-solid fa-file-excel text-green-600 mr-2"></i> Ekspor Excel
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 p-4 rounded-lg text-green-700 text-sm font-medium flex items-center">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Sleek Segmented Controls -->
    <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg w-fit">
        <button @click="tab = 'accepted'" :class="tab === 'accepted' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-5 py-2 rounded-md font-medium text-sm transition-all flex items-center">
            <i class="fa-solid fa-check text-green-500 mr-2"></i> Diterima ({{ $accepted->count() }})
        </button>
        <button @click="tab = 'rejected'" :class="tab === 'rejected' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-5 py-2 rounded-md font-medium text-sm transition-all flex items-center">
            <i class="fa-solid fa-xmark text-red-500 mr-2"></i> Ditolak ({{ $rejected->count() }})
        </button>
    </div>

    <!-- Tab Diterima -->
    <div x-show="tab === 'accepted'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($accepted as $app)
                <div class="bg-white p-5 rounded-xl border border-gray-200 hover:shadow-md transition-shadow relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-green-500 rounded-t-xl"></div>
                    <div class="flex items-center gap-4 mb-4 mt-2">
                        <img src="{{ asset('storage/' . $app->profile_photo) }}" alt="Foto" class="w-12 h-12 rounded-full object-cover border border-gray-100 bg-gray-50">
                        <div class="overflow-hidden">
                            <h3 class="font-bold text-gray-900 truncate">{{ $app->full_name ?? $app->user->name }}</h3>
                            <p class="text-xs text-gray-500 truncate">{{ $app->vacancy->title }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mb-5">
                        <span class="bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded">Periode: {{ $app->internship_period }}</span>
                    </div>
                    <button @click="openModal = {{ $app->id }}" class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-2 rounded-lg text-xs font-semibold transition-colors">Detail Profil</button>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200 text-sm">Belum ada data pelamar yang diterima.</div>
            @endforelse
        </div>
    </div>

    <!-- Tab Ditolak -->
    <div x-show="tab === 'rejected'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($rejected as $app)
                <div class="bg-white p-5 rounded-xl border border-gray-200 hover:shadow-md transition-shadow relative opacity-80 hover:opacity-100">
                    <div class="absolute top-0 left-0 w-full h-1 bg-red-400 rounded-t-xl"></div>
                    <div class="flex items-center gap-4 mb-4 mt-2">
                        <img src="{{ asset('storage/' . $app->profile_photo) }}" alt="Foto" class="w-12 h-12 rounded-full object-cover border border-gray-100 bg-gray-50 grayscale">
                        <div class="overflow-hidden">
                            <h3 class="font-bold text-gray-900 truncate">{{ $app->full_name ?? $app->user->name }}</h3>
                            <p class="text-xs text-gray-500 truncate">{{ $app->vacancy->title }}</p>
                        </div>
                    </div>
                    <button @click="openModal = {{ $app->id }}" class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-2 rounded-lg text-xs font-semibold transition-colors">Cek & Hapus Data</button>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200 text-sm">Belum ada riwayat penolakan.</div>
            @endforelse
        </div>
    </div>

    <!-- Clean Corporate Modal -->
    @foreach($accepted->concat($rejected) as $app)
        <div x-show="openModal === {{ $app->id }}" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center z-[100] p-4" style="display: none;" x-transition.opacity>
            <div @click.away="openModal = null" class="bg-white rounded-xl overflow-hidden max-w-3xl w-full shadow-2xl flex flex-col max-h-[90vh]">
                
                <div class="bg-white border-b border-gray-100 p-5 flex justify-between items-center">
                    <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i class="fa-regular fa-folder-open text-gray-400"></i> Detail Dokumen Pelamar
                    </h2>
                    <button @click="openModal = null" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fa-solid fa-xmark text-lg"></i></button>
                </div>
                
                <div class="p-6 overflow-y-auto custom-scrollbar">
                    <div class="flex flex-col sm:flex-row gap-6 mb-8">
                        <img src="{{ asset('storage/' . $app->profile_photo) }}" alt="Foto" class="w-24 h-24 rounded-lg object-cover border border-gray-200 shadow-sm flex-shrink-0">
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 leading-none">{{ $app->full_name ?? $app->user->name }}</h3>
                                    <p class="text-imersa-deep font-medium mt-1">{{ $app->vacancy->title }}</p>
                                </div>
                                <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded border {{ $app->status === 'Accepted' ? 'bg-green-50 border-green-200 text-green-700' : 'bg-red-50 border-red-200 text-red-700' }}">
                                    {{ $app->status }}
                                </span>
                            </div>
                            
                            <!-- Penambahan Detail Informasi -->
                            <div class="grid grid-cols-2 gap-y-4 gap-x-6 mt-6 text-sm">
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Kontak</p><p class="text-gray-900">{{ $app->email }} <br> {{ $app->phone }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Data Diri</p><p class="text-gray-900">{{ $app->gender }} <br> {{ $app->birth_date }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Ketersediaan</p><p class="text-gray-900">{{ $app->internship_period }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Sumber Info</p><p class="text-gray-900">{{ $app->source ?? '-' }}</p></div>
                                <div class="col-span-2"><p class="text-[10px] uppercase font-bold text-gray-400">Sistem & Lokasi Penempatan</p><p class="text-gray-900 font-medium">{{ $app->location ?? 'Tidak ada data' }}</p></div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6 space-y-5 text-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div><p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Institusi & Jurusan</p><p class="text-gray-900 bg-gray-50 p-3 rounded-md border border-gray-100">{{ $app->institution }} - {{ $app->major }}</p></div>
                            <div><p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Alamat Domisili</p><p class="text-gray-900 bg-gray-50 p-3 rounded-md border border-gray-100">{{ $app->address }}</p></div>
                        </div>
                        <div><p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Motivasi Bergabung</p><p class="text-gray-700 bg-gray-50 p-4 rounded-md border border-gray-100 leading-relaxed text-sm">"{{ $app->motivation }}"</p></div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center pt-6 mt-6 border-t border-gray-100 gap-4">
                        <div class="flex gap-2 w-full sm:w-auto">
                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank" class="flex-1 sm:flex-none text-center bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-gray-50 transition-colors"><i class="fa-solid fa-file-pdf text-red-500 mr-1"></i> File CV</a>
                            @if($app->portfolio)<a href="{{ asset('storage/' . $app->portfolio) }}" target="_blank" class="flex-1 sm:flex-none text-center bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-gray-50 transition-colors"><i class="fa-solid fa-link text-blue-500 mr-1"></i> Portofolio</a>@endif
                        </div>
                        
                        <form action="{{ route('admin.application.destroy', $app->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Hapus permanen riwayat atas nama {{ $app->full_name }}? Data tidak dapat dipulihkan.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full sm:w-auto bg-white border border-red-200 hover:bg-red-50 text-red-600 px-4 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center justify-center">
                                <i class="fa-regular fa-trash-can mr-2"></i> Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection 