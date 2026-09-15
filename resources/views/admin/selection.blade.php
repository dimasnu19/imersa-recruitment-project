@extends('layouts.app')

@section('content')
<div class="space-y-6" x-data="{ openModal: null }">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Kelola Seleksi Kanban</h1>
            <p class="text-sm text-gray-500 mt-1">Validasi dan pindahkan status pelamar yang masuk.</p>
        </div>
    </div>

    @if(session('success')) 
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium flex items-center">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div> 
    @endif
    
    @if(session('error')) 
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm font-medium flex items-center">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
        </div> 
    @endif

    <div class="flex flex-col lg:flex-row gap-6 items-start h-full">
        
        <!-- KOLOM 1: LAMARAN DITERIMA -->
        <div class="flex-1 w-full bg-gray-50/80 rounded-xl border border-gray-200 p-3 flex flex-col h-[calc(100vh-200px)]">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="font-bold text-gray-800 text-sm flex items-center uppercase tracking-wider">
                    <i class="fa-solid fa-inbox text-gray-400 mr-2"></i> Masuk Baru
                </h3>
                <span class="bg-white border border-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded-full font-bold">{{ count($kanbanData['Lamaran Diterima'] ?? []) }}</span>
            </div>
            
            <div class="space-y-3 overflow-y-auto custom-scrollbar flex-1 pr-1">
                @forelse($kanbanData['Lamaran Diterima'] ?? [] as $app)
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:border-gray-300 transition-all group">
                    <h4 class="font-bold text-gray-900 text-sm">{{ $app->full_name ?? ($app->user->name ?? 'Unknown') }}</h4>
                    <p class="text-xs text-gray-500 mb-4 mt-0.5">{{ $app->vacancy->title ?? '-' }}</p>
                    
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <button type="button" @click="openModal = {{ $app->id }}" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-1.5 rounded-md text-xs font-semibold transition-colors text-center">Detail</button>
                        <form action="{{ route('admin.application.updateStatus', $app->id) }}" method="POST">
                            @csrf <input type="hidden" name="status" value="Validated">
                            <button type="submit" class="w-full bg-imersa-deep hover:bg-imersa-gem text-white py-1.5 rounded-md text-xs font-semibold transition-colors text-center border border-transparent">Validasi &rarr;</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="h-full flex items-center justify-center border-2 border-dashed border-gray-200 rounded-lg bg-gray-50/50 min-h-[150px]">
                    <p class="text-xs text-gray-400 font-medium">Kosong</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- KOLOM 2: VALIDASI DATA -->
        <div class="flex-1 w-full bg-blue-50/40 rounded-xl border border-blue-100 p-3 flex flex-col h-[calc(100vh-200px)]">
            <div class="flex items-center justify-between mb-4 px-1">
                <h3 class="font-bold text-imersa-deep text-sm flex items-center uppercase tracking-wider">
                    <i class="fa-solid fa-list-check opacity-70 mr-2"></i> Tahap Validasi
                </h3>
                <span class="bg-blue-100 text-imersa-deep text-xs px-2 py-0.5 rounded-full font-bold">{{ count($kanbanData['Validasi Data'] ?? []) }}</span>
            </div>
            
            <div class="space-y-3 overflow-y-auto custom-scrollbar flex-1 pr-1">
                @forelse($kanbanData['Validasi Data'] ?? [] as $app)
                <div class="bg-white p-4 rounded-lg border border-blue-200 shadow-sm hover:border-imersa-gem transition-all flex flex-col">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">{{ $app->full_name ?? ($app->user->name ?? 'Unknown') }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $app->vacancy->title ?? '-' }}</p>
                        </div>
                        <button type="button" @click="openModal = {{ $app->id }}" class="text-gray-400 hover:text-imersa-deep transition-colors p-1" title="Cek Dokumen">
                            <i class="fa-regular fa-folder-open"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 mt-2 pt-3 border-t border-gray-100">
                        <form action="{{ route('admin.application.updateStatus', $app->id) }}" method="POST" onsubmit="return confirm('Tolak pelamar ini? Data akan dipindah ke arsip Ditolak.')">
                            @csrf <input type="hidden" name="status" value="Rejected">
                            <button type="submit" class="w-full bg-white border border-red-200 hover:bg-red-50 text-red-600 py-1.5 rounded-md text-xs font-semibold transition-colors flex justify-center items-center gap-1">Tolak</button>
                        </form>
                        <form action="{{ route('admin.application.updateStatus', $app->id) }}" method="POST" onsubmit="return confirm('Terima pelamar ini? Data akan dipindah ke arsip Diterima.')">
                            @csrf <input type="hidden" name="status" value="Accepted">
                            <button type="submit" class="w-full bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-1.5 rounded-md text-xs font-semibold transition-colors flex justify-center items-center gap-1">Terima</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="h-full flex items-center justify-center border-2 border-dashed border-blue-100 rounded-lg bg-white/50 min-h-[150px]">
                    <p class="text-xs text-blue-300 font-medium">Kosong</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Clean Modal -->
    @php $allApps = collect($kanbanData['Lamaran Diterima'] ?? [])->merge($kanbanData['Validasi Data'] ?? []); @endphp

    @foreach($allApps as $app)
        <div x-show="openModal === {{ $app->id }}" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center z-[100] p-4" style="display: none;" x-transition.opacity>
            <div @click.away="openModal = null" class="bg-white rounded-xl overflow-hidden max-w-3xl w-full shadow-2xl flex flex-col max-h-[90vh]">
                <div class="bg-white border-b border-gray-100 p-5 flex justify-between items-center">
                    <h2 class="text-base font-bold text-gray-900 flex items-center gap-2"><i class="fa-regular fa-folder-open text-gray-400"></i> Review Dokumen</h2>
                    <button @click="openModal = null" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fa-solid fa-xmark text-lg"></i></button>
                </div>
                <div class="p-6 overflow-y-auto custom-scrollbar">
                    <div class="flex flex-col sm:flex-row gap-6 mb-8">
                        <div class="w-24 h-24 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                            @if($app->profile_photo) <img src="{{ asset('storage/' . $app->profile_photo) }}" alt="Foto" class="w-full h-full object-cover">
                            @else <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fa-solid fa-user text-3xl"></i></div> @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 leading-none">{{ $app->full_name ?? ($app->user->name ?? 'Unknown') }}</h3>
                            <p class="text-imersa-deep font-medium mt-1 mb-4">{{ $app->vacancy->title ?? '-' }}</p>
                            
                            <!-- Penambahan Detail Informasi -->
                            <div class="grid grid-cols-2 gap-y-3 gap-x-6 text-sm">
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Kontak</p><p class="text-gray-900">{{ $app->email }} <br> {{ $app->phone }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Data Diri</p><p class="text-gray-900">{{ $app->gender }} <br> {{ $app->birth_date }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Ketersediaan</p><p class="text-gray-900">{{ $app->internship_period }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-gray-400">Sumber Info</p><p class="text-gray-900">{{ $app->source ?? '-' }}</p></div>
                                <div class="col-span-2"><p class="text-[10px] uppercase font-bold text-gray-400">Sistem & Lokasi Penempatan</p><p class="text-gray-900 font-medium">{{ $app->location ?? 'Tidak ada data' }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-5 space-y-4 text-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Institusi & Jurusan</p><p class="text-gray-900 bg-gray-50 p-2.5 rounded border border-gray-100">{{ $app->institution }} - {{ $app->major }}</p></div>
                            <div><p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Alamat</p><p class="text-gray-900 bg-gray-50 p-2.5 rounded border border-gray-100">{{ $app->address }}</p></div>
                        </div>
                        <div><p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Motivasi</p><p class="text-gray-700 bg-gray-50 p-3 rounded border border-gray-100 italic">"{{ $app->motivation }}"</p></div>
                    </div>
                    <div class="flex gap-2 pt-5 border-t border-gray-100 mt-5">
                        @if($app->cv) <a href="{{ asset('storage/' . $app->cv) }}" target="_blank" class="bg-white border border-gray-200 text-gray-700 px-4 py-1.5 rounded-md text-xs font-semibold hover:bg-gray-50"><i class="fa-solid fa-file-pdf text-red-500 mr-1"></i> File CV</a> @endif
                        @if($app->portfolio) <a href="{{ asset('storage/' . $app->portfolio) }}" target="_blank" class="bg-white border border-gray-200 text-gray-700 px-4 py-1.5 rounded-md text-xs font-semibold hover:bg-gray-50"><i class="fa-solid fa-link text-blue-500 mr-1"></i> Portofolio</a> @endif
                        @if($app->recommendation_letter) <a href="{{ asset('storage/' . $app->recommendation_letter) }}" target="_blank" class="bg-white border border-gray-200 text-gray-700 px-4 py-1.5 rounded-md text-xs font-semibold hover:bg-gray-50">Surat Pengantar</a> @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection