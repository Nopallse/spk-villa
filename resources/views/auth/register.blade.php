<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Villa Sleman</title>
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
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <div class="hero-gradient absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white p-8">
                    <h3 class="text-4xl font-bold mb-4">Bergabung Dengan Kami!</h3>
                    <p class="text-xl mb-8">Dapatkan akses ke sistem rekomendasi villa terbaik di Sleman</p>
                    <div class="grid grid-cols-1 gap-6 max-w-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas fa-user-check text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold">Akun Personal</h4>
                                <p class="text-sm opacity-90">Dashboard khusus untuk Anda</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas fa-heart text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold">Simpan Favorit</h4>
                                <p class="text-sm opacity-90">Villa favorit tersimpan aman</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas fa-history text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold">Riwayat Pencarian</h4>
                                <p class="text-sm opacity-90">Akses hasil pencarian lama</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="w-full max-w-sm lg:w-96">
                <div>
                    <div class="flex items-center space-x-2 mb-8">
                        <i class="fas fa-home text-3xl text-primary-600"></i>
                        <span class="text-2xl font-bold text-gray-900">VillaSleman</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Daftar Akun Baru
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        Terjadi kesalahan:
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul role="list" class="list-disc space-y-1 pl-5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap
                            </label>
                            <div class="mt-1 relative">
                                <input id="name" name="name" type="text" autocomplete="name" required 
                                       class="appearance-none block w-full px-3 py-2 pl-10 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                       placeholder="Masukkan nama lengkap Anda"
                                       value="{{ old('name') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </label>
                            <div class="mt-1 relative">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                       class="appearance-none block w-full px-3 py-2 pl-10 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                       placeholder="Masukkan email Anda"
                                       value="{{ old('email') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1 relative">
                                <input id="password" name="password" type="password" autocomplete="new-password" required 
                                       class="appearance-none block w-full px-3 py-2 pl-10 pr-10 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                       placeholder="Masukkan password Anda">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-600">
                                        <i id="password-icon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Konfirmasi Password
                            </label>
                            <div class="mt-1 relative">
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                                       class="appearance-none block w-full px-3 py-2 pl-10 pr-10 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                       placeholder="Ulangi password Anda">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="text-gray-400 hover:text-gray-600">
                                        <i id="password_confirmation-icon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required 
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-900">
                                Saya menyetujui 
                                <a href="#" class="text-primary-600 hover:text-primary-500 font-medium">Syarat & Ketentuan</a>
                                dan 
                                <a href="#" class="text-primary-600 hover:text-primary-500 font-medium">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit" 
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out"
                                    style="background-color: #1ba7a7;">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar Sekarang
                            </button>
                        </div>

                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-gray-50 text-gray-500">Atau</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('welcome') }}" 
                                   class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <i class="fas fa-home mr-2"></i>
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const passwordIcon = document.getElementById(fieldId + '-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Auto-focus name field
        document.getElementById('name').focus();

        // Password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation && password !== confirmation) {
                this.setCustomValidity('Password tidak sama');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
