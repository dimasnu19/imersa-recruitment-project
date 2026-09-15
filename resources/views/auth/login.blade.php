<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Recruitment PT Imersa</title>
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
<body class="bg-imersa-bg flex items-center justify-center min-h-screen p-4 font-sans relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-imersa-gem/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-imersa-deep/10 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full relative z-10" x-data="{ showPassword: false }">
        <div class="bg-white p-10 rounded-[2rem] shadow-[0_20px_50px_rgba(0,75,143,0.05)] border border-white">
            
            <div class="flex justify-center mb-8">
                <div class="bg-white p-4 rounded-2xl shadow-sm">
                    <img src="{{ asset('images/logo-imersa.png') }}" alt="Logo Imersa" class="h-16 w-auto">
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-extrabold text-imersa-deep tracking-tight">Selamat Datang</h2>
                <p class="text-gray-500 text-sm mt-1.5">Silakan masuk ke portal karir PT Imersa</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50/80 border border-red-100 p-4 rounded-xl flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
                    <div>
                        <p class="text-red-700 text-xs font-bold uppercase tracking-wider mb-1">Kesalahan Login</p>
                        <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Alamat Email</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-imersa-gem transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                            class="block w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-imersa-gem/20 focus:border-imersa-gem transition-all outline-none text-gray-800 bg-gray-50/50 hover:bg-gray-50 font-medium text-sm placeholder-gray-400" 
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-2 ml-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest">Kata Sandi</label>
                    </div>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-imersa-gem transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input :type="showPassword ? 'text' : 'password'" name="password" required 
                            class="block w-full pl-11 pr-12 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-imersa-gem/20 focus:border-imersa-gem transition-all outline-none text-gray-800 bg-gray-50/50 hover:bg-gray-50 font-medium text-sm tracking-wide placeholder-gray-400" 
                            placeholder="••••••••">
                        
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-imersa-gem transition-colors">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.225 0 2.37.221 3.425.625M19.175 19.175L5 5M14.121 14.121a3 3 0 10-4.242-4.242m4.242 4.242L9.88 9.88"></path></svg>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-imersa-deep to-imersa-gem text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-[0.98] flex justify-center items-center gap-2">
                        Masuk Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-imersa-gem hover:text-imersa-deep transition-colors">Daftar Pelamar</a>
                </p>
            </div>
        </div>
        
        <p class="text-center mt-8 text-gray-400 text-xs font-medium">
            &copy; 2026 PT Imersa Solusi Teknologi. All rights reserved.
        </p>
    </div>

</body>
</html>