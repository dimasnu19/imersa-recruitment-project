@extends('layouts.app')

@section('content')
<div class="space-y-8 pb-12 max-w-4xl mx-auto">

    <div class="relative overflow-hidden bg-gradient-to-r from-imersa-deep to-imersa-gem rounded-2xl p-8 text-white shadow-lg">
        <div class="relative z-10">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded border border-white/10 text-[10px] font-bold uppercase tracking-widest mb-3">
                Pendaftaran Baru
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">Formulir Pendaftaran Magang</h1>
            <p class="text-imersa-light text-sm opacity-90 leading-relaxed max-w-2xl">
                Lengkapi data diri Anda dengan teliti. Data yang dikirimkan bersifat permanen dan akan langsung ditinjau oleh tim HRD.
            </p>
        </div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-24 -mt-24 blur-2xl"></div>
    </div>

    <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">

        <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-imersa-gem mr-3">
                <i class="fa-solid fa-pen-to-square text-lg"></i>
            </div>
            <h2 class="text-lg font-bold text-imersa-deep">Data Pelamar</h2>
        </div>

        <form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex gap-4 shadow-sm mb-6">
                <div class="text-imersa-gem mt-1 hidden sm:block">
                    <i class="fa-solid fa-building-user text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-imersa-deep text-sm mb-1">Informasi Penempatan Magang</h3>
                    <p class="text-xs text-gray-700 leading-relaxed">
                        Perlu kami sampaikan bahwa <em>office</em> PT Imersa Solusi Teknologi berkonsep <strong>Coworking Space</strong> yang lokasinya menyatu dengan cafe. Anda dapat menyesuaikan penempatan magang/PKL dengan domisili terdekat (WFO), atau memilih sistem kerja jarak jauh (WFH).
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">

                <div class="col-span-1 md:col-span-2 border-b border-gray-100 pb-5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Divisi Magang <span class="text-red-500">*</span></label>
                    <select name="vacancy_id" required 
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none">
                        <option value="" disabled selected>Pilih Divisi yang dituju...</option>
                        @foreach($vacancies as $vacancy)
                            <option value="{{ $vacancy->id }}">{{ $vacancy->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div x-data="{ workSystem: '' }" class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5 pb-2">
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Sistem Kerja <span class="text-red-500">*</span></label>
                        <select x-model="workSystem" required class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none">
                            <option value="" disabled selected>Pilih Sistem Kerja...</option>
                            <option value="WFO">WFO (Work From Office)</option>
                            <option value="WFH">WFH (Work From Home / Remote)</option>
                        </select>
                        
                        <input type="hidden" name="location" value="WFH (Kerja Jarak Jauh)" x-bind:disabled="workSystem !== 'WFH'">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide mb-2 transition-colors" :class="workSystem !== 'WFO' ? 'text-gray-400' : 'text-gray-700'">
                            Lokasi Penempatan <span x-show="workSystem === 'WFO'" class="text-red-500">*</span>
                        </label>
                        <select name="location" 
                            x-bind:disabled="workSystem !== 'WFO'" 
                            x-bind:required="workSystem === 'WFO'" 
                            class="w-full px-3.5 py-2.5 rounded-lg border transition-all text-sm outline-none"
                            :class="workSystem !== 'WFO' ? 'bg-gray-100 border-gray-200 text-gray-400 cursor-not-allowed opacity-70' : 'bg-gray-50 border-gray-300 text-gray-900 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep'">
                            <option value="" disabled selected>Pilih Lokasi Coworking Space...</option>
                            
                            @if(isset($locations) && $locations->count() > 0)
                                @foreach($locations as $city => $cityLocations)
                                    <optgroup label="{{ $city }}">
                                        @foreach($cityLocations as $loc)
                                            <option value="{{ $loc->name }}">{{ $loc->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @else
                                <option value="Menunggu Data HRD">Menunggu Data HRD</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="full_name" required placeholder="Sesuai KTP/Kartu Pelajar"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Email Aktif <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required placeholder="nama@gmail.com"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">No HP/WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" required placeholder="0812xxxx"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="birth_date" required 
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="gender" required 
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none">
                        <option value="" disabled selected>Pilih Gender...</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Periode Magang <span class="text-red-500">*</span></label>
                    <select name="internship_period" required 
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none">
                        <option value="" disabled selected>Pilih Durasi...</option>
                        <option value="3 Bulan">3 Bulan</option>
                        <option value="6 Bulan">6 Bulan</option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="2" required placeholder="Tuliskan alamat lengkap saat ini..."
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Asal Sekolah/Kampus <span class="text-red-500">*</span></label>
                    <input type="text" name="institution" required placeholder="Cth: Universitas Gadjah Mada"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Program Studi/Jurusan <span class="text-red-500">*</span></label>
                    <input type="text" name="major" required placeholder="Cth: Teknik Informatika"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Sumber Informasi Magang <span class="text-red-500">*</span></label>
                    <select name="source" required 
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none">
                        <option value="" disabled selected>Pilih referensi...</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Facebook">Facebook</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Website">Website</option>
                        <option value="Teman/Saudara">Teman/Saudara</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Motivasi Bergabung <span class="text-red-500">*</span></label>
                    <textarea name="motivation" rows="3" required placeholder="Jelaskan alasan Anda ingin magang di PT Imersa..."
                        class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-imersa-deep focus:ring-1 focus:ring-imersa-deep transition-all text-sm text-gray-900 outline-none placeholder-gray-400"></textarea>
                </div>

                <div class="col-span-1 md:col-span-2 mt-2 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-imersa-deep mb-4 flex items-center"><i class="fa-solid fa-cloud-arrow-up text-gray-400 mr-2"></i> Unggah Dokumen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Foto Profil (JPG/PNG) <span class="text-red-500">*</span></label>
                            <input type="file" name="profile_photo" required accept="image/*"
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:font-semibold file:bg-blue-50 file:text-imersa-deep hover:file:bg-imersa-gem hover:file:text-white transition-all cursor-pointer border border-gray-200 rounded p-1 bg-white">
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Curriculum Vitae (PDF) <span class="text-red-500">*</span></label>
                            <input type="file" name="cv" required accept=".pdf"
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:font-semibold file:bg-blue-50 file:text-imersa-deep hover:file:bg-imersa-gem hover:file:text-white transition-all cursor-pointer border border-gray-200 rounded p-1 bg-white">
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Portofolio (Opsional, PDF)</label>
                            <input type="file" name="portfolio" accept=".pdf"
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 transition-all cursor-pointer border border-gray-200 rounded p-1 bg-white">
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Surat Pengantar (Opsional, PDF)</label>
                            <input type="file" name="recommendation_letter" accept=".pdf"
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 transition-all cursor-pointer border border-gray-200 rounded p-1 bg-white">
                        </div>

                    </div>
                </div>

            </div>

            <div class="pt-6 mt-2 border-t border-gray-100">
                <button type="submit" 
                    class="w-full md:w-auto bg-gradient-to-r from-imersa-deep to-imersa-gem hover:from-[#003366] hover:to-imersa-deep text-white px-8 py-3.5 rounded-lg font-bold text-sm shadow-md shadow-blue-200 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                    Kirim Lamaran Magang <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection