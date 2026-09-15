@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Katalog Divisi Pendaftaran</h1>
            <p class="text-sm text-gray-500 mt-1">Buat dan kelola divisi beserta kuota yang akan ditampilkan di formulir pendaftaran.</p>
        </div>
    </div>

    @if(session('success')) 
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div> 
    @endif

    @if(session('error')) 
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
        </div> 
    @endif

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center"><i class="fa-solid fa-plus text-gray-400 mr-2"></i> Tambah Divisi Baru</h2>
        <form action="{{ route('admin.vacancies.store') }}" method="POST" class="flex flex-col md:flex-row gap-3">
            @csrf
            
            <div class="flex-[3]">
                <select name="title" required class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep outline-none text-sm transition-all bg-gray-50 focus:bg-white text-gray-800">
                    <option value="" disabled selected>Pilih Divisi Magang...</option>
                    
                    <optgroup label="Software Engineering">
                        <option value="Web Development">Web Development</option>
                        <option value="Fullstack Developer">Fullstack Developer</option>
                        <option value="Frontend Developer">Frontend Developer</option>
                        <option value="Backend Developer">Backend Developer</option>
                        <option value="Mobile Apps">Mobile Apps</option>
                    </optgroup>
                    
                    <optgroup label="Creative & Multimedia">
                        <option value="Graphic Design">Graphic Design</option>
                        <option value="Video Editor">Video Editor</option>
                        <option value="UI/UX Designer">UI/UX Designer</option>
                    </optgroup>
                    
                    <optgroup label="Business & Operational">
                        <option value="Digital Marketing">Digital Marketing</option>
                        <option value="Network & IT Support">Network & IT Support</option>
                        <option value="Admin & Finance">Admin & Finance</option>
                    </optgroup>
                    
                    <optgroup label="Lainnya">
                        <option value="Lainnya">Posisi Lainnya</option>
                    </optgroup>
                </select>
            </div>
            
            <div class="flex-[2]">
                <input type="number" name="description" min="1" required placeholder="Kuota Dibutuhkan (Cth: 5)" class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep outline-none text-sm transition-all bg-gray-50 focus:bg-white placeholder-gray-400">
            </div>
            
            <button type="submit" class="bg-imersa-deep hover:bg-imersa-gem text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors whitespace-nowrap shadow-sm">Tambah Data</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider text-[10px] font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Nama Divisi</th>
                        <th class="px-6 py-4">Status Visibilitas</th>
                        <th class="px-6 py-4">Statistik & Kuota</th>
                        <th class="px-6 py-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($vacancies as $v)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-900">{{ $v->title }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.vacancies.update', $v->id) }}" method="POST" class="inline-block">
                                @csrf @method('PUT')
                                <input type="hidden" name="title" value="{{ $v->title }}">
                                <input type="hidden" name="description" value="{{ $v->description }}">
                                <select name="is_active" onchange="this.form.submit()" class="text-xs font-semibold rounded outline-none cursor-pointer py-1 pl-2 pr-6 border {{ $v->is_active ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
                                    <option value="1" {{ $v->is_active ? 'selected' : '' }}>🟢 Aktif (Publik)</option>
                                    <option value="0" {{ !$v->is_active ? 'selected' : '' }}>⚫ Disembunyikan</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200 w-fit">
                                    <i class="fa-solid fa-bullseye text-[10px] text-gray-400"></i> Kuota: {{ $v->description }} Orang
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-blue-50 text-imersa-deep border border-blue-100 w-fit">
                                    <i class="fa-solid fa-users text-[10px]"></i> Terdaftar: {{ $v->applications_count }} Pelamar
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right align-middle">
                            @if($v->applications_count == 0)
                            <form action="{{ route('admin.vacancies.destroy', $v->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus divisi {{ $v->title }} secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600 hover:bg-red-50 p-2 rounded transition-colors" title="Hapus Divisi">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                            @else
                            <span class="text-[10px] text-gray-400 font-medium uppercase px-2">Data Terkunci</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <i class="fa-solid fa-folder-open text-3xl mb-3 opacity-20 block"></i>
                            <span class="text-sm font-medium">Belum ada divisi yang dibuat.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection