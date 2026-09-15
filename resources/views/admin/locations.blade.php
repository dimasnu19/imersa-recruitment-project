@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Katalog Lokasi Penempatan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola daftar lokasi WFO (Coworking Space) maupun opsi WFH untuk form pelamar.</p>
        </div>
    </div>

    @if(session('success')) 
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div> 
    @endif

    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center"><i class="fa-solid fa-location-dot text-gray-400 mr-2"></i> Tambah Lokasi Baru</h2>
        <form action="{{ route('admin.locations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3">
            @csrf
            
            <div class="md:col-span-1">
                <select name="city" required class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep outline-none text-sm transition-all bg-gray-50 focus:bg-white text-gray-800">
                    <option value="" disabled selected>Pilih Area/Kota...</option>
                    <option value="Remote / Bebas">Remote / WFH</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                    <option value="Solo">Solo</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Depok">Depok (UI)</option>
                    <option value="Semarang">Semarang</option>
                    <option value="Malang">Malang</option>
                    <option value="Nganjuk">Nganjuk</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <input type="text" name="name" required placeholder="Nama Tempat & Alamat (Cth: Imersa x English Cafe UII)" class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep outline-none text-sm transition-all bg-gray-50 focus:bg-white placeholder-gray-400">
            </div>

            <div class="md:col-span-1">
                <button type="submit" class="w-full bg-imersa-deep hover:bg-imersa-gem text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider text-[10px] font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Area / Kota</th>
                        <th class="px-6 py-4">Nama Tempat & Alamat Lengkap</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($locations ?? [] as $loc)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-imersa-deep">{{ $loc->city }}</td>
                        <td class="px-6 py-4 text-gray-700 whitespace-normal min-w-[250px]">{{ $loc->name }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[10px] font-bold bg-green-50 text-green-700 border border-green-200">
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.locations.destroy', $loc->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus lokasi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600 hover:bg-red-50 p-2 rounded transition-colors" title="Hapus Lokasi">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <i class="fa-solid fa-map-location-dot text-3xl mb-3 opacity-20 block"></i>
                            <span class="text-sm font-medium">Belum ada data lokasi yang didaftarkan.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection