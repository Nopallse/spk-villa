<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Villa Sleman - Sistem Pendukung Keputusan Rekomendasi Villa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fafa',
                            100: '#d9f2f2', 
                            200: '#b8e6e6',
                            300: '#87d4d4',
                            400: '#4fb8b8', 
                            500: '#1ba7a7',
                            600: '#1ba7a7',
                            700: '#178888',
                            800: '#175757',
                            900: '#184949'
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #1ba7a7 0%, #178888 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-home text-2xl text-primary-600"></i>
                    <span class="text-xl font-bold text-gray-800">VillaSleman</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-primary-600 transition">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-primary-600 transition">Tentang</a>
                    <a href="#villa" class="text-gray-700 hover:text-primary-600 transition">Villa</a>
                    <a href="#kontak" class="text-gray-700 hover:text-primary-600 transition">Kontak</a>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition" style="background-color: #1ba7a7;">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="border border-primary-600 text-primary-600 px-6 py-2 rounded-lg hover:bg-primary-50 transition" style="border-color: #1ba7a7; color: #1ba7a7;">
                            Daftar
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition" style="background-color: #1ba7a7;">
                            Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-gradient min-h-screen flex items-center pt-16">
        <div class="container mx-auto px-6 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Temukan Villa Impian Anda
                <br><span class="text-yellow-300">di Kabupaten Sleman</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                Sistem Pendukung Keputusan berbasis AHP dan TOPSIS untuk membantu Anda menemukan villa terbaik sesuai preferensi dan kebutuhan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#villa" class="bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
                    <i class="fas fa-search mr-2"></i>
                    Cari Villa Sekarang
                </a>
                <a href="#tentang" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-600 transition">
                    <i class="fas fa-info-circle mr-2"></i>
                    Pelajari Lebih Lanjut
                </a>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                <div class="text-center">
                    <div class="text-4xl font-bold text-yellow-300">50+</div>
                    <div class="text-lg">Villa Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-yellow-300">1000+</div>
                    <div class="text-lg">Pengunjung Puas</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-yellow-300">98%</div>
                    <div class="text-lg">Akurasi Rekomendasi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang Sistem Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Menggunakan metode ilmiah AHP dan TOPSIS untuk memberikan rekomendasi villa terbaik
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Mengapa Memilih Kami?</h3>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-brain text-primary-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Metode AHP (Analytical Hierarchy Process)</h4>
                                <p class="text-gray-600">Sistem menentukan bobot kriteria berdasarkan preferensi Anda secara ilmiah</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-chart-line text-primary-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Metode TOPSIS</h4>
                                <p class="text-gray-600">Ranking villa berdasarkan kedekatan dengan solusi ideal positif</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-shield-alt text-primary-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Data Terpercaya</h4>
                                <p class="text-gray-600">Informasi villa yang akurat dan selalu diperbarui</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                         alt="Villa Modern" 
                         class="rounded-lg shadow-2xl w-full max-w-md mx-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Criteria Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Kriteria Penilaian</h2>
                <p class="text-xl text-gray-600">6 kriteria utama yang kami gunakan untuk menentukan rekomendasi villa terbaik</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-6 shadow-lg card-hover">
                    <div class="text-center mb-4">
                        <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-dollar-sign text-primary-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Harga Sewa</h3>
                        <p class="text-gray-600 mt-2">Tarif sewa villa per malam yang sesuai dengan budget Anda</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-lg card-hover">
                    <div class="text-center mb-4">
                        <div class="bg-primary-200 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marker-alt text-primary-700 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Lokasi</h3>
                        <p class="text-gray-600 mt-2">Kemudahan akses dan kedekatan dengan objek wisata</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-lg card-hover">
                    <div class="text-center mb-4">
                        <div class="bg-primary-300 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-swimming-pool text-primary-800 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Fasilitas</h3>
                        <p class="text-gray-600 mt-2">Kelengkapan fasilitas seperti kolam renang, WiFi, AC</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-lg card-hover">
                    <div class="text-center mb-4">
                        <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sparkles text-primary-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Kebersihan</h3>
                        <p class="text-gray-600 mt-2">Tingkat kebersihan dan maintenance villa</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-lg card-hover">
                    <div class="text-center mb-4">
                        <div class="bg-primary-200 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-star text-primary-700 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Rating & Ulasan</h3>
                        <p class="text-gray-600 mt-2">Penilaian dari pengunjung sebelumnya</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-lg card-hover">
                    <div class="text-center mb-4">
                        <div class="bg-primary-300 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-primary-800 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Kapasitas</h3>
                        <p class="text-gray-600 mt-2">Jumlah tamu yang dapat ditampung villa</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Villas -->
    <section id="villa" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Villa Terpopuler</h2>
                <p class="text-xl text-gray-600">Beberapa villa terbaik berdasarkan rekomendasi sistem kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Villa 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Villa Sleman Paradise" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Villa Sleman Paradise</h3>
                        <p class="text-gray-600 mb-4">Villa mewah dengan pemandangan Merapi yang menawan</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-primary-600">Rp 850K</span>
                            <span class="text-gray-500">/malam</span>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-gray-600">(4.9) · 12 ulasan</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-swimming-pool mr-1"></i>Kolam Renang
                            </span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-wifi mr-1"></i>WiFi
                            </span>
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-users mr-1"></i>8 Orang
                            </span>
                        </div>
                        <button class="w-full bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Villa 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover">
                    <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Villa Prambanan View" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Villa Prambanan View</h3>
                        <p class="text-gray-600 mb-4">Dekat dengan Candi Prambanan dan fasilitas lengkap</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-primary-600">Rp 650K</span>
                            <span class="text-gray-500">/malam</span>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="ml-2 text-gray-600">(4.7) · 8 ulasan</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-car mr-1"></i>Parkir
                            </span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-utensils mr-1"></i>Dapur
                            </span>
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-users mr-1"></i>6 Orang
                            </span>
                        </div>
                        <button class="w-full bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Villa 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Villa Kaliurang Retreat" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Villa Kaliurang Retreat</h3>
                        <p class="text-gray-600 mb-4">Suasana pegunungan yang sejuk dan menyegarkan</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-primary-600">Rp 750K</span>
                            <span class="text-gray-500">/malam</span>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-gray-600">(4.8) · 15 ulasan</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-mountain mr-1"></i>View Merapi
                            </span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-fire mr-1"></i>BBQ Area
                            </span>
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
                                <i class="fas fa-users mr-1"></i>10 Orang
                            </span>
                        </div>
                        <button class="w-full bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('login') }}" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition inline-block">
                    <i class="fas fa-search mr-2"></i>
                    Lihat Semua Villa & Mulai Pencarian
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Cara Kerja Sistem</h2>
                <p class="text-xl text-gray-600">Proses sederhana untuk mendapatkan rekomendasi villa terbaik</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Daftar/Masuk</h3>
                    <p class="text-gray-600">Buat akun atau masuk ke sistem untuk mulai menggunakan layanan</p>
                </div>

                <div class="text-center">
                    <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Tentukan Preferensi</h3>
                    <p class="text-gray-600">Atur tingkat kepentingan setiap kriteria sesuai kebutuhan Anda</p>
                </div>

                <div class="text-center">
                    <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Sistem Menghitung</h3>
                    <p class="text-gray-600">AHP & TOPSIS memproses data dan menghitung ranking villa</p>
                </div>

                <div class="text-center">
                    <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">4</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dapatkan Rekomendasi</h3>
                    <p class="text-gray-600">Lihat daftar villa yang diurutkan dari yang terbaik untuk Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-home text-2xl text-primary-400"></i>
                        <span class="text-xl font-bold">VillaSleman</span>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Sistem Pendukung Keputusan untuk rekomendasi villa terbaik di Kabupaten Sleman dengan metode AHP dan TOPSIS.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu Utama</h3>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-300 hover:text-white transition">Beranda</a></li>
                        <li><a href="#tentang" class="text-gray-300 hover:text-white transition">Tentang</a></li>
                        <li><a href="#villa" class="text-gray-300 hover:text-white transition">Villa</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Masuk</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Fitur</h3>
                    <ul class="space-y-2">
                        <li class="text-gray-300">Pencarian Villa</li>
                        <li class="text-gray-300">Analisis AHP</li>
                        <li class="text-gray-300">Ranking TOPSIS</li>
                        <li class="text-gray-300">Laporan PDF</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope"></i>
                            <span class="text-gray-300">info@villasleman.com</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-phone"></i>
                            <span class="text-gray-300">+62 274 123456</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="text-gray-300">Sleman, Yogyakarta</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">
                    © 2024 VillaSleman. Semua hak dilindungi. Sistem Pendukung Keputusan Rekomendasi Villa.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for smooth scrolling -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('#mobile-menu-btn');
        const mobileMenu = document.querySelector('#mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
