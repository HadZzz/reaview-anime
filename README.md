# AnimeVault

AnimeVault adalah aplikasi web untuk mencari, mereview, dan mendapatkan rekomendasi anime. Dibangun dengan Laravel dan mengintegrasikan Jikan API untuk data anime.

## Fitur

- 🎯 **Pencarian Anime**: Cari anime berdasarkan judul
- 📊 **Detail Anime**: Lihat informasi lengkap tentang anime (sinopsis, rating, episode, dll)
- ⭐ **Sistem Review**: 
  - Posting review dengan rating (1-10)
  - Edit dan hapus review sendiri
  - Lihat review dari pengguna lain
- 🔍 **Sistem Rekomendasi**: Dapatkan rekomendasi anime berdasarkan genre
- 👤 **Manajemen Akun**:
  - Registrasi dan login
  - Edit profil
  - Manajemen review

## Teknologi

- Laravel 11
- PHP 8.3
- MySQL
- Tailwind CSS
- Jikan API (MyAnimeList)

## Persyaratan Sistem

- PHP >= 8.3
- Composer
- MySQL
- Node.js & NPM

## Instalasi

1. Clone repository
```bash
git clone https://github.com/HadZzz/reaview-anime.git
cd reaview-anime
```

2. Install dependensi PHP
```bash
composer install
```

3. Install dependensi JavaScript
```bash
npm install
```

4. Salin file .env
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Konfigurasi database di file .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=animevault
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database
```bash
php artisan migrate
```

8. Compile assets
```bash
npm run dev
```

9. Jalankan server
```bash
php artisan serve / 
php -S localhost:8000 -t public/
```

Aplikasi akan berjalan di `http://localhost:8000`

## Penggunaan

1. **Register/Login**
   - Klik tombol Register untuk membuat akun baru
   - Atau Login jika sudah memiliki akun

2. **Mencari Anime**
   - Gunakan search bar di navbar
   - Masukkan judul anime yang ingin dicari

3. **Melihat Detail Anime**
   - Klik pada judul atau gambar anime
   - Lihat informasi lengkap, review, dan rekomendasi

4. **Membuat Review**
   - Login ke akun Anda
   - Buka halaman detail anime
   - Isi form review dengan rating dan komentar
   - Klik "Post Review"

## Kontribusi

Kontribusi selalu diterima! Berikut langkah-langkah untuk berkontribusi:

1. Fork repository
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

[MIT License](LICENSE.md)

## Kontak

HadZzz - [@HadZzz](https://github.com/HadZzz)

Project Link: [https://github.com/HadZzz/reaview-anime](https://github.com/HadZzz/reaview-anime)
