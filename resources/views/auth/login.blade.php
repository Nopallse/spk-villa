<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Villa Sleman</title>
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
        <!-- Left Side - Form -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="w-full max-w-sm lg:w-96">
                <div>
                    <div class="flex items-center space-x-2 mb-8">
                        <i class="fas fa-home text-3xl text-primary-600"></i>
                        <span class="text-2xl font-bold text-gray-900">VillaSleman</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Masuk ke Akun Anda
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Atau 
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                            daftar akun baru
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

                    @if (session('status'))
                        <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('status') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
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
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                       class="appearance-none block w-full px-3 py-2 pl-10 pr-10 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                       placeholder="Masukkan password Anda">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-gray-600">
                                        <i id="password-icon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox" 
                                       class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                    Ingat saya
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                    Lupa password?
                                </a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" 
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out"
                                    style="background-color: #1ba7a7;">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk
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

        <!-- Right Side - Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <div class="hero-gradient absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white p-8">
                    <h3 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h3>
                    <p class="text-xl mb-8">Temukan villa impian Anda dengan sistem rekomendasi terpercaya</p>
                    <div class="grid grid-cols-1 gap-6 max-w-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas fa-brain text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold">Analisis AHP</h4>
                                <p class="text-sm opacity-90">Metode ilmiah untuk keputusan</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas fa-chart-line text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold">Ranking TOPSIS</h4>
                                <p class="text-sm opacity-90">Solusi optimal teruji</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas fa-shield-alt text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold">Data Terpercaya</h4>
                                <p class="text-sm opacity-90">Informasi akurat & terkini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Auto-focus email field
        document.getElementById('email').focus();
    </script>
</body>
</html>
