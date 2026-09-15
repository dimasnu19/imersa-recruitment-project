<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Imersa Solusi Teknologi - IT & Digital Agency</title>
    
    <!-- Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
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
    
    <!-- Alpine JS & FontAwesome -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-imersa-bg font-sans text-gray-700 antialiased overflow-x-hidden selection:bg-imersa-gem selection:text-white">

    <!-- NAVIGATION -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100 transition-all duration-300" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-300" :class="scrolled ? 'h-16' : 'h-24'">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-imersa.png') }}" alt="Logo Imersa" class="h-8 md:h-10 w-auto">
                    <!-- Alternatif jika logo belum ada: -->
                    <!-- <span class="text-2xl font-black text-imersa-deep tracking-tighter ml-2">IMERSA</span> -->
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-sm font-semibold text-gray-600 hover:text-imersa-deep transition-colors">Beranda</a>
                    <a href="#profil" class="text-sm font-semibold text-gray-600 hover:text-imersa-deep transition-colors">Profil Perusahaan</a>
                    <a href="#layanan" class="text-sm font-semibold text-gray-600 hover:text-imersa-deep transition-colors">Layanan</a>
                    <a href="#contact" class="text-sm font-semibold text-gray-600 hover:text-imersa-deep transition-colors">Hubungi Kami</a>
                    <div class="w-px h-6 bg-gray-200"></div>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white bg-imersa-deep hover:bg-imersa-gem rounded-lg transition-all shadow-md shadow-blue-900/20">
                        Portal Karir <i class="fa-solid fa-arrow-right-to-bracket ml-2"></i>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-imersa-deep focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#home" @click="mobileMenuOpen = false" class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 rounded-lg">Beranda</a>
                <a href="#profil" @click="mobileMenuOpen = false" class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 rounded-lg">Profil Perusahaan</a>
                <a href="#layanan" @click="mobileMenuOpen = false" class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 rounded-lg">Layanan</a>
                <a href="#contact" @click="mobileMenuOpen = false" class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 rounded-lg">Hubungi Kami</a>
                <a href="{{ route('login') }}" class="block px-3 py-3 text-base font-bold text-imersa-deep bg-blue-50 hover:bg-blue-100 rounded-lg mt-4 text-center">Portal Karir & Magang</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (Elegant Slider) -->
    <section id="home" class="relative pt-24 lg:pt-0 lg:min-h-screen flex items-center justify-center bg-white overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-50/50 skew-x-12 translate-x-32 hidden lg:block"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-12 lg:py-32"
             x-data="{ 
                active: 0, 
                slides: [
                    { tag: 'DUDI & Institusi Pendidikan', title: 'Sinkronisasi Kurikulum & Pendidikan Industri', desc: 'Imersa menjalin kerjasama dengan SMK sebagai DUDI untuk program sinkronisasi kurikulum, kelas industri, COE, hingga magang guru.', cta: 'Pelajari Kerjasama', link: '#contact' },
                    { tag: 'Guru Tamu & Kelas Industri', title: 'Mencetak Wirausaha Muda Teknologi', desc: 'Tim Imersa menjadi guru tamu untuk program kelas industri SMK guna mencetak lulusan yang handal di bidang IT dan Digital Marketing.', cta: 'Program Kelas', link: '#layanan' },
                    { tag: 'Program PKL & OJT', title: 'Inkubator Talenta Digital Masa Depan', desc: 'Didampingi mentor ahli dengan fasilitas lengkap: full wifi, tempat ibadah, dan ruang training khusus untuk pengembangan skill mahasiswa & siswa SMK.', cta: 'Portal Rekrutmen', link: '#magang' },
                    { tag: 'Uji Kompetensi (UKK)', title: 'Mitra Resmi Uji Kompetensi Keahlian', desc: 'DUDI resmi untuk pelaksanaan UKK SMK setiap tahun bagi kelas XII guna memastikan kualitas kelulusan sesuai dengan standar industri nyata.', cta: 'Konsultasi UKK', link: '#contact' }
                ],
                next() { this.active = (this.active + 1) % this.slides.length }
             }" 
             x-init="setInterval(() => next(), 6000)">
            
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                
                <!-- Left: Text Content -->
                <div class="flex-1 w-full text-center lg:text-left min-h-[300px] flex flex-col justify-center">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="active === index" 
                             x-transition:enter="transition ease-out duration-700 delay-100"
                             x-transition:enter-start="opacity-0 translate-y-8"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-300 absolute w-full"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="w-full">
                            
                            <span class="inline-block py-1 px-3 rounded-md bg-blue-50 text-imersa-deep text-xs font-extrabold uppercase tracking-widest mb-6" x-text="slide.tag"></span>
                            
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight leading-[1.1] mb-6">
                                <span x-text="slide.title"></span>
                            </h1>
                            
                            <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-2xl mx-auto lg:mx-0" x-text="slide.desc"></p>
                            
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                                <a :href="slide.link" class="w-full sm:w-auto px-8 py-3.5 bg-imersa-deep hover:bg-imersa-gem text-white font-bold rounded-lg shadow-lg shadow-blue-900/20 transition-all text-center">
                                    <span x-text="slide.cta"></span>
                                </a>
                                <a href="#profil" class="w-full sm:w-auto px-8 py-3.5 bg-white border border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-gray-700 font-bold rounded-lg transition-all text-center">
                                    Profil Kami
                                </a>
                            </div>
                        </div>
                    </template>

                    <!-- Custom Indicators -->
                    <div class="flex items-center justify-center lg:justify-start gap-3 mt-12">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="active = index" 
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :class="active === index ? 'w-8 bg-imersa-deep' : 'w-2 bg-gray-300 hover:bg-gray-400'"></button>
                        </template>
                    </div>
                </div>

                <!-- Right: Corporate Image/Pillars -->
                <div class="flex-1 w-full grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                    <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all group">
                        <div class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center mb-6 text-imersa-deep group-hover:bg-imersa-deep group-hover:text-white transition-colors">
                            <i class="fa-solid fa-handshake text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Center of Excellence</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Pusat keunggulan pendidikan vokasi melalui sinkronisasi kurikulum industri yang relevan.</p>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all group sm:translate-y-8">
                        <div class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center mb-6 text-imersa-deep group-hover:bg-imersa-deep group-hover:text-white transition-colors">
                            <i class="fa-solid fa-users-gear text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Magang Guru</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Peningkatan kompetensi teknis bagi pengajar agar tetap selaras dengan teknologi terkini.</p>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all group sm:-translate-y-4">
                        <div class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center mb-6 text-imersa-deep group-hover:bg-imersa-deep group-hover:text-white transition-colors">
                            <i class="fa-solid fa-rocket text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Kesiapan Kerja</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Membantu sekolah memastikan kualitas kelulusan siap kerja di industri kreatif digital.</p>
                    </div>
                    <div class="bg-imersa-deep p-8 rounded-2xl shadow-lg text-white flex flex-col justify-between sm:translate-y-4 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 text-white/10 text-9xl"><i class="fa-solid fa-quote-right"></i></div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold mb-4">Budaya Kami</h3>
                            <p class="text-sm text-blue-100 italic leading-relaxed">"Tim Imersa adalah talenta muda yang tidak suka mengeluh, terus belajar dan fokus pada solusi di setiap tantangan."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COMPANY PROFILE SECTION -->
    <section id="profil" class="py-24 bg-imersa-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-extrabold text-imersa-gem uppercase tracking-widest mb-3">Siapa Kami</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Profil Perusahaan</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <!-- Visi -->
                <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-imersa-deep"><i class="fa-solid fa-eye text-2xl"></i></div>
                        <h3 class="text-2xl font-extrabold text-gray-900">Visi Kami</h3>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed">Menjadi perusahaan teknologi informasi yang secara konsisten memberikan benefit bernilai tinggi untuk UMKM, Korporat, maupun Pemerintahan.</p>
                </div>

                <!-- Misi -->
                <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-imersa-deep"><i class="fa-solid fa-bullseye text-2xl"></i></div>
                        <h3 class="text-2xl font-extrabold text-gray-900">Misi Kami</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="mt-1 mr-4 flex-shrink-0 w-6 h-6 rounded-full bg-green-50 flex items-center justify-center"><i class="fa-solid fa-check text-green-500 text-xs"></i></div>
                            <span class="text-gray-600">Menjadi tim yang selalu dapat mencari solusi tepat dalam setiap tantangan.</span>
                        </li>
                        <li class="flex items-start">
                            <div class="mt-1 mr-4 flex-shrink-0 w-6 h-6 rounded-full bg-green-50 flex items-center justify-center"><i class="fa-solid fa-check text-green-500 text-xs"></i></div>
                            <span class="text-gray-600">Menciptakan produk teknologi dan sistem informasi yang berdampak positif.</span>
                        </li>
                        <li class="flex items-start">
                            <div class="mt-1 mr-4 flex-shrink-0 w-6 h-6 rounded-full bg-green-50 flex items-center justify-center"><i class="fa-solid fa-check text-green-500 text-xs"></i></div>
                            <span class="text-gray-600">Menjadi tim yang fokus dan tuntas melaksanakan pekerjaan.</span>
                        </li>
                        <li class="flex items-start">
                            <div class="mt-1 mr-4 flex-shrink-0 w-6 h-6 rounded-full bg-green-50 flex items-center justify-center"><i class="fa-solid fa-check text-green-500 text-xs"></i></div>
                            <span class="text-gray-600">Menjadi tim yang cepat dan handal dalam melayani pengguna.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="layanan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-extrabold text-imersa-gem uppercase tracking-widest mb-3">Layanan Kami</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Apa yang kami kerjakan untuk Anda?</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Service 1 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-imersa-deep hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <i class="fa-solid fa-globe text-3xl text-gray-400 group-hover:text-imersa-deep mb-5 transition-colors"></i>
                    <h4 class="font-bold text-gray-900 mb-2">Web Development</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Kesan pertama perusahaan Anda tersampaikan dengan jelas & menarik melalui website korporat.</p>
                </div>
                <!-- Service 2 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-imersa-deep hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <i class="fa-solid fa-mobile-screen text-3xl text-gray-400 group-hover:text-imersa-deep mb-5 transition-colors"></i>
                    <h4 class="font-bold text-gray-900 mb-2">Mobile App</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Tingkatkan kemajuan bisnis Anda dalam genggaman pelanggan dengan aplikasi yang responsif.</p>
                </div>
                <!-- Service 3 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-imersa-deep hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <i class="fa-solid fa-sitemap text-3xl text-gray-400 group-hover:text-imersa-deep mb-5 transition-colors"></i>
                    <h4 class="font-bold text-gray-900 mb-2">Information System</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Bisnis lebih efektif & efisien dengan sistem informasi kustom yang terintegrasi penuh.</p>
                </div>
                <!-- Service 4 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-imersa-deep hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <i class="fa-solid fa-building-columns text-3xl text-gray-400 group-hover:text-imersa-deep mb-5 transition-colors"></i>
                    <h4 class="font-bold text-gray-900 mb-2">Gov Tech</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Meningkatkan kemudahan dan transparansi Tata Kelola Pemerintahan yang terdigitalisasi.</p>
                </div>
                <!-- Service 5 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-imersa-deep hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <i class="fa-solid fa-user-tie text-3xl text-gray-400 group-hover:text-imersa-deep mb-5 transition-colors"></i>
                    <h4 class="font-bold text-gray-900 mb-2">Consulting Service</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Dukungan solusi IT profesional dengan perspektif baru untuk mempercepat adopsi teknologi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- RECRUITMENT / MAGANG SECTION -->
    <section id="magang" class="py-24 bg-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-imersa-deep rounded-full blur-[100px] opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-block py-1 px-3 rounded border border-gray-700 text-gray-300 text-xs font-bold uppercase tracking-widest mb-6">Karir & Edukasi</span>
                    <h2 class="text-3xl lg:text-5xl font-extrabold text-white mb-6 leading-tight">Portal E-Recruitment <br><span class="text-imersa-gem">Magang & PKL</span></h2>
                    <p class="text-lg text-gray-400 mb-8 max-w-2xl mx-auto lg:mx-0">PT Imersa Solusi Teknologi membuka kesempatan emas bagi Siswa SMK dan Mahasiswa untuk merasakan pengalaman langsung di Dunia Usaha/Industri (DUDI), didampingi mentor profesional.</p>
                    
                    <div class="mb-10">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">Divisi Tersedia:</p>
                        <div class="flex flex-wrap justify-center lg:justify-start gap-2">
                            <span class="bg-gray-800 text-gray-300 px-3 py-1.5 rounded-md text-sm border border-gray-700">Web Dev (RPL)</span>
                            <span class="bg-gray-800 text-gray-300 px-3 py-1.5 rounded-md text-sm border border-gray-700">Mobile Apps</span>
                            <span class="bg-gray-800 text-gray-300 px-3 py-1.5 rounded-md text-sm border border-gray-700">Digital Marketing</span>
                            <span class="bg-gray-800 text-gray-300 px-3 py-1.5 rounded-md text-sm border border-gray-700">Desain Grafis</span>
                            <span class="bg-gray-800 text-gray-300 px-3 py-1.5 rounded-md text-sm border border-gray-700">Jaringan (TKJ)</span>
                            <span class="bg-gray-800 text-gray-300 px-3 py-1.5 rounded-md text-sm border border-gray-700">Administrasi</span>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-[450px]">
                    <div class="bg-white p-8 sm:p-10 rounded-2xl shadow-2xl relative">
                        <div class="absolute top-0 right-0 p-4 opacity-10"><i class="fa-solid fa-graduation-cap text-6xl text-imersa-deep"></i></div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Siap Bergabung?</h3>
                        <p class="text-gray-500 text-sm mb-8">Gunakan sistem E-Recruitment kami untuk mendaftar, mengunggah dokumen, dan memantau status seleksi secara real-time.</p>
                        
                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 bg-imersa-deep hover:bg-imersa-gem text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-blue-500/30 group">
                            Masuk Portal Pendaftaran <i class="fa-solid fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                        </a>
                        <p class="text-center text-xs text-gray-400 mt-4">Diperlukan pembuatan akun pelamar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="py-24 bg-imersa-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-extrabold text-imersa-gem uppercase tracking-widest mb-3">Lokasi Kami</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Hubungi & Kunjungi Kami</h3>
            </div>

            <!-- Contact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <a href="mailto:mail@imersa.co.id" class="flex items-center p-6 bg-white rounded-2xl border border-gray-100 hover:border-imersa-deep hover:shadow-md transition-all">
                    <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center text-imersa-deep mr-5"><i class="fa-solid fa-envelope text-2xl"></i></div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Email Resmi</p>
                        <p class="text-lg font-bold text-gray-900">mail@imersa.co.id</p>
                    </div>
                </a>
                <a href="https://wa.me/6285755896233" target="_blank" class="flex items-center p-6 bg-white rounded-2xl border border-gray-100 hover:border-green-500 hover:shadow-md transition-all">
                    <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center text-green-500 mr-5"><i class="fa-brands fa-whatsapp text-3xl"></i></div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">WhatsApp Official</p>
                        <p class="text-lg font-bold text-gray-900">0857-5589-6233</p>
                    </div>
                </a>
            </div>

            <!-- Office Locations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gray-200 group-hover:bg-imersa-gem transition-colors"></div>
                    <h4 class="font-bold text-gray-900 mb-3 text-lg">Kantor Nganjuk 1</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">RT 001 / RW 005 Lobeser Timur, Baron, Nganjuk, Jawa Timur 64394</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gray-200 group-hover:bg-imersa-gem transition-colors"></div>
                    <h4 class="font-bold text-gray-900 mb-3 text-lg">Kantor Nganjuk 2</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Jl. Puntodewo No. 2 Baron, Nganjuk, Jawa Timur 64394</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gray-200 group-hover:bg-imersa-deep transition-colors"></div>
                    <h4 class="font-bold text-gray-900 mb-3 text-lg">Kantor Yogyakarta</h4>
                    <p class="text-sm text-gray-500 leading-relaxed mb-3">Purwosari, Sinduadi, Kec. Mlati, Kabupaten Sleman, DIY 55284</p>
                    <p class="text-sm font-bold text-imersa-deep"><i class="fa-solid fa-phone mr-1"></i> 0856-0430-9961</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gray-200 group-hover:bg-imersa-deep transition-colors"></div>
                    <h4 class="font-bold text-gray-900 mb-3 text-lg">Kantor Kertosono</h4>
                    <p class="text-sm text-gray-500 leading-relaxed mb-3">Jl. Mastrip, Lambang Kuning, Kec. Kertosono, Nganjuk, Jatim 64315</p>
                    <p class="text-sm font-bold text-imersa-deep"><i class="fa-solid fa-phone mr-1"></i> 0856-5502-3555</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                <!-- Branding -->
                <div class="md:col-span-5">
                    <img src="{{ asset('images/logo-imersa.png') }}" alt="Logo Imersa" class="h-8 w-auto mb-6">
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 pr-4">PT Imersa Solusi Teknologi adalah perusahaan IT profesional penyedia layanan pembuatan Website, Mobile App, Sistem Informasi Pemerintahan, serta fasilitator resmi PKL SMK dan Magang Mahasiswa.</p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/imersadigitalmarketing/" target="_blank" class="w-9 h-9 rounded-lg bg-gray-100 text-gray-500 hover:bg-imersa-deep hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/imersa.co.id/" target="_blank" class="w-9 h-9 rounded-lg bg-gray-100 text-gray-500 hover:bg-imersa-deep hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.youtube.com/c/Imersa" target="_blank" class="w-9 h-9 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Links -->
                <div class="md:col-span-3">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6">Akses Cepat</h4>
                    <ul class="space-y-4">
                        <li><a href="#home" class="text-sm text-gray-500 hover:text-imersa-deep font-medium transition-colors">Beranda</a></li>
                        <li><a href="#profil" class="text-sm text-gray-500 hover:text-imersa-deep font-medium transition-colors">Tentang Kami</a></li>
                        <li><a href="#layanan" class="text-sm text-gray-500 hover:text-imersa-deep font-medium transition-colors">Layanan IT</a></li>
                        <li><a href="#magang" class="text-sm text-gray-500 hover:text-imersa-deep font-medium transition-colors">Informasi Magang</a></li>
                    </ul>
                </div>

                <!-- CTA -->
                <div class="md:col-span-4">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6">Peluang Kerjasama</h4>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Kami membuka peluang kerjasama untuk menjadikan bisnis Anda Go Digital. Diskusikan kebutuhan sistem Anda bersama tim analis kami.</p>
                    <a href="#contact" class="inline-block border border-gray-300 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-colors text-sm font-bold">Mari Berdiskusi</a>
                </div>
            </div>
            
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-xs font-medium">&copy; 2026 PT Imersa Solusi Teknologi. All rights reserved.</p>
                <div class="flex items-center gap-2">
                    <span class="text-gray-400 text-xs">Sistem Rekrutmen by</span>
                    <span class="text-gray-600 text-xs font-bold bg-gray-100 px-2 py-1 rounded">Dimas Nugroho</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>