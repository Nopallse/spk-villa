# VillaSleman - Sistem Pendukung Keputusan Rekomendasi Villa

## Deskripsi Sistem

Sistem Pendukung Keputusan Rekomendasi Villa di Kabupaten Sleman adalah aplikasi web berbasis Laravel yang menggunakan metode **AHP (Analytical Hierarchy Process)** dan **TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)** untuk memberikan rekomendasi villa terbaik sesuai preferensi pengguna.

## Fitur Sistem

### 🏠 **Halaman Public**
- **Landing Page** (`welcome.blade.php`) - Halaman utama dengan informasi sistem dan preview villa
- **Authentication** - Login & Register untuk pengguna

### 👤 **Fitur Pengguna**

#### Dashboard User
- **Dashboard** (`dashboard.blade.php`) - Ringkasan sistem dan aksi cepat
- **Input Preferensi** (`preferences.blade.php`) - Form input kriteria dengan skala Likert (1-5)
- **Perbandingan AHP** (`ahp-comparison.blade.php`) - Perbandingan berpasangan kriteria dengan skala Saaty
- **Hasil Rekomendasi** (`results.blade.php`) - Ranking villa berdasarkan skor TOPSIS
- **Detail Villa** (`villa-detail.blade.php`) - Informasi lengkap villa dan evaluasi kriteria

#### Proses Rekomendasi
1. **Langkah 1**: Input preferensi kriteria (Harga, Lokasi, Fasilitas, Kebersihan, Rating, Kapasitas)
2. **Langkah 2**: Perbandingan berpasangan AHP untuk menentukan bobot kriteria
3. **Langkah 3**: Perhitungan TOPSIS untuk ranking villa
4. **Langkah 4**: Tampilan hasil rekomendasi dengan skor dan detail

### 🔧 **Fitur Administrator**

#### Dashboard Admin
- **Admin Dashboard** (`admin-dashboard.blade.php`) - Statistik sistem dan manajemen
- **Manajemen Villa** (`admin/villas.blade.php`) - CRUD villa dengan filter dan pencarian

#### Manajemen Data
- **Villa Management** - Tambah, edit, hapus, dan kelola data villa
- **Criteria Management** - Kelola kriteria penilaian
- **User Management** - Kelola pengguna sistem
- **Calculation History** - Riwayat perhitungan rekomendasi
- **Reports & Analytics** - Laporan dan analisis sistem

## Kriteria Penilaian Villa

### 6 Kriteria Utama:

1. **💰 Harga Sewa** (Cost)
   - Pertimbangan biaya sewa per malam
   - Semakin murah semakin baik

2. **📍 Lokasi** (Benefit)
   - Kemudahan akses dan kedekatan dengan objek wisata
   - Semakin strategis semakin baik

3. **🏊 Fasilitas** (Benefit)
   - Kelengkapan fasilitas (kolam renang, WiFi, AC, dll)
   - Semakin lengkap semakin baik

4. **✨ Kebersihan** (Benefit)
   - Tingkat kebersihan dan maintenance villa
   - Semakin bersih semakin baik

5. **⭐ Rating & Ulasan** (Benefit)
   - Penilaian dari tamu sebelumnya
   - Semakin tinggi rating semakin baik

6. **👥 Kapasitas** (Benefit)
   - Jumlah tamu yang dapat ditampung
   - Semakin sesuai kebutuhan semakin baik

## Metode Perhitungan

### 🧠 **AHP (Analytical Hierarchy Process)**
- Perbandingan berpasangan kriteria menggunakan skala Saaty (1-9)
- Perhitungan bobot prioritas melalui eigenvector
- Uji konsistensi dengan Consistency Ratio (CR ≤ 0.1)

### 📊 **TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)**
- Normalisasi matriks keputusan
- Pembobotan dengan hasil AHP
- Perhitungan jarak ke solusi ideal positif dan negatif
- Ranking berdasarkan Closeness Coefficient

## Struktur File Views

```
resources/views/
├── welcome.blade.php              # Landing page
├── dashboard.blade.php            # Dashboard user
├── preferences.blade.php          # Input preferensi kriteria
├── ahp-comparison.blade.php       # Perbandingan AHP
├── results.blade.php              # Hasil rekomendasi TOPSIS
├── villa-detail.blade.php         # Detail villa
├── admin-dashboard.blade.php      # Dashboard admin
├── admin/
│   └── villas.blade.php           # Manajemen villa
└── layouts/
    └── navigation.blade.php       # Navigation menu
```

## Teknologi yang Digunakan

- **Framework**: Laravel 10+
- **Frontend**: Tailwind CSS, Alpine.js
- **Icons**: Font Awesome
- **Database**: MySQL/PostgreSQL
- **JavaScript**: Vanilla JS untuk interaktivitas
- **Authentication**: Laravel Breeze

## Fitur UI/UX

### 🎨 **Design System**
- **Color Palette**: Purple (#6366f1) sebagai primary color
- **Typography**: Inter font family
- **Components**: Modern card-based layout
- **Responsive**: Mobile-first design
- **Icons**: Font Awesome untuk consistency

### 🔄 **Interactive Elements**
- Smooth transitions dan hover effects
- Progress indicators untuk multi-step forms
- Real-time validation dan feedback
- Modal dialogs untuk actions
- Dropdown menus dan tooltips

### 📱 **Responsive Design**
- Mobile-first approach
- Tablet dan desktop optimization
- Hamburger menu untuk mobile
- Grid system yang fleksibel

## Workflow Pengguna

### 👤 **User Journey**
1. **Landing** → Informasi sistem dan motivasi
2. **Register/Login** → Autentikasi pengguna
3. **Dashboard** → Overview dan quick actions
4. **Preferensi** → Input tingkat kepentingan kriteria
5. **AHP** → Perbandingan berpasangan kriteria
6. **Rekomendasi** → Hasil ranking villa dengan skor TOPSIS
7. **Detail** → Informasi lengkap villa pilihan

### 🔧 **Admin Journey**
1. **Admin Dashboard** → Statistik dan monitoring sistem
2. **Villa Management** → CRUD data villa
3. **User Management** → Kelola pengguna
4. **Reports** → Analytics dan insights

## Keunggulan Sistem

### 🎯 **Akurasi Tinggi**
- Metode ilmiah AHP & TOPSIS
- Consistency checking untuk validasi
- Multi-criteria decision making

### 🚀 **User Experience**
- Interface yang intuitif dan modern
- Step-by-step guidance
- Real-time feedback dan progress tracking

### 📈 **Scalability**
- Admin panel untuk manajemen data
- Sistem yang mudah diperluas
- Database design yang optimal

### 🔒 **Security**
- Authentication & authorization
- Input validation
- Secure data handling

## Implementasi Teknis

### 🗄️ **Database Schema**
- `users` - Data pengguna dan admin
- `villas` - Data villa dan attributnya
- `criteria` - Kriteria penilaian
- `villa_scores` - Nilai villa per kriteria
- `user_preferences` - Preferensi pengguna
- `ahp_comparisons` - Hasil perbandingan AHP
- `recommendations` - Riwayat rekomendasi

### 🔄 **API Endpoints**
- Authentication routes
- Villa management routes
- Preference input routes
- AHP calculation routes
- TOPSIS calculation routes
- Report generation routes

## Panduan Penggunaan

### 🚀 **Setup & Installation**
1. Clone repository
2. Install dependencies (`composer install`, `npm install`)
3. Setup database configuration
4. Run migrations & seeders
5. Build frontend assets (`npm run build`)
6. Start development server (`php artisan serve`)

### 👨‍💻 **Development**
- Follow Laravel best practices
- Use Tailwind for styling
- Implement responsive design
- Add proper validation
- Include error handling

## Kontributor

Sistem ini dikembangkan sebagai implementasi Sistem Pendukung Keputusan untuk rekomendasi villa di Kabupaten Sleman dengan menggabungkan teknologi web modern dan metode pengambilan keputusan yang proven.

---

**VillaSleman** - *Finding Your Perfect Villa with Smart Recommendations*