<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - E-Recruitment PT Imersa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
</head>
<body class="bg-imersa-bg flex items-center justify-center min-h-screen p-4 md:p-6 font-sans relative overflow-hidden">

    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-imersa-gem/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-imersa-deep/10 rounded-full blur-3xl"></div>

    <div class="max-w-lg w-full relative z-10" x-data="{ showPassword: false }">
        <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-[0_20px_50px_rgba(0,75,143,0.05)] border border-white">
            
            <div class="flex justify-center mb-8">
                <div class="bg-white p-4 rounded-2xl shadow-sm">
                    <img src="{{ asset('images/logo-imersa.png') }}" alt="Logo Imersa" class="h-16 w-auto">
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-extrabold text-imersa-deep tracking-tight">Buat Akun</h2>
                <p class="text-gray-500 text-sm mt-1.5">Lengkapi data di bawah untuk mulai melamar magang</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50/80 border border-red-100 p-4 rounded-xl">
                    <p class="text-red-700 text-xs font-bold uppercase tracking-wider mb-2">Periksa Kembali Data Anda</p>
                    <ul class="text-red-600 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start gap-2">
                                <span class="mt-1 flex-shrink-0"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5 ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-imersa-gem transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                            class="block w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-imersa-gem/20 focus:border-imersa-gem transition-all outline-none text-gray-800 bg-gray-50/50 hover:bg-gray-50 font-medium text-sm placeholder-gray-400" 
                            placeholder="Sesuai KTP / Tanda Pengenal">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5 ml-1">Alamat Email</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-imersa-gem transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                            class="block w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-imersa-gem/20 focus:border-imersa-gem transition-all outline-none text-gray-800 bg-gray-50/50 hover:bg-gray-50 font-medium text-sm placeholder-gray-400" 
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5 ml-1">Kata Sandi</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-imersa-gem transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input :type="showPassword ? 'text' : 'password'" name="password" required 
                                class="block w-full pl-10 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-imersa-gem/20 focus:border-imersa-gem transition-all outline-none text-gray-800 bg-gray-50/50 hover:bg-gray-50 font-medium text-sm tracking-wide placeholder-gray-400" 
                                placeholder="Min. 8 karakter">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5 ml-1">Ulangi Sandi</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-imersa-gem transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </span>
                            <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" required 
                                class="block w-full pl-10 pr-10 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-imersa-gem/20 focus:border-imersa-gem transition-all outline-none text-gray-800 bg-gray-50/50 hover:bg-gray-50 font-medium text-sm tracking-wide placeholder-gray-400" 
                                placeholder="Ketik ulang sandi">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2 px-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" @click="showPassword = !showPassword" class="peer appearance-none w-4 h-4 border border-gray-300 rounded bg-gray-50 checked:bg-imersa-gem checked:border-imersa-gem transition-all cursor-pointer">
                            <svg class="absolute w-3 h-3 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs text-gray-500 font-medium group-hover:text-gray-700 transition-colors">Tampilkan Kata Sandi</span>
                    </label>

                    <label class="flex items-start sm:items-center gap-2 cursor-pointer group">
                        <div class="relative flex items-center justify-center mt-0.5 sm:mt-0">
                            <input type="checkbox" required class="peer appearance-none w-4 h-4 border border-gray-300 rounded bg-gray-50 checked:bg-imersa-gem checked:border-imersa-gem transition-all cursor-pointer">
                            <svg class="absolute w-3 h-3 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs text-gray-500 font-medium leading-tight">Saya setuju dengan <a href="#" class="text-imersa-gem hover:text-imersa-deep transition-colors">Syarat & Ketentuan</a>.</span>
                    </label>
                </div>

                <div class="pt-3">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-imersa-deep to-imersa-gem text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-[0.98] flex justify-center items-center gap-2">
                        Daftar Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Sudah punya akun pelamar? 
                    <a href="{{ route('login') }}" class="font-bold text-imersa-gem hover:text-imersa-deep transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>
        
        <p class="text-center mt-8 text-gray-400 text-xs font-medium">
            &copy; 2026 PT Imersa Solusi Teknologi. All rights reserved.
        </p>
    </div>

</body>
</html>