@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Statistik</h1>
            <p class="text-sm text-gray-500 mt-1">Ringkasan pendaftaran magang PT Imersa Solusi Teknologi.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Main Metric -->
        <div class="bg-imersa-deep p-6 rounded-xl text-white shadow-sm relative overflow-hidden flex flex-col justify-between h-32 md:col-span-1">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <i class="fa-solid fa-chart-line text-6xl"></i>
            </div>
            <p class="text-xs font-medium text-blue-200 uppercase tracking-wider">Total Lamaran</p>
            <h2 class="text-4xl font-bold tracking-tight">{{ $totalApplications }}</h2>
        </div>
    </div>

    <div class="pt-4">
        <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Distribusi per Divisi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($stats as $stat)
            <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-imersa-gem hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-5">
                    <h3 class="font-bold text-gray-900">{{ $stat->title }}</h3>
                    <div class="w-8 h-8 bg-gray-50 group-hover:bg-blue-50 text-gray-400 group-hover:text-imersa-gem rounded-lg flex items-center justify-center transition-colors">
                        <i class="fa-solid {{ $stat->icon }} text-sm"></i>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Total Pendaftar</span>
                        <span class="font-semibold text-gray-900">{{ $stat->total_applicants }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span> Seleksi</span>
                        <span class="font-medium text-gray-700">{{ $stat->active_count }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Diterima</span>
                        <span class="font-medium text-gray-700">{{ $stat->accepted_count }}</span>
                    </div>
                </div>
                
                @if($stat->total_applicants > 0)
                <div class="w-full bg-gray-100 rounded-full h-1.5 mt-5 overflow-hidden flex">
                    <div class="bg-green-500 h-1.5 transition-all" style="width: {{ ($stat->accepted_count / $stat->total_applicants) * 100 }}%"></div>
                    <div class="bg-yellow-400 h-1.5 transition-all" style="width: {{ ($stat->active_count / $stat->total_applicants) * 100 }}%"></div>
                </div>
                @else
                <div class="w-full bg-gray-50 rounded-full h-1.5 mt-5"></div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection