# Portal Berita API - Tugas UTS Backend

Repository ini berisi kode sumber untuk Backend API Portal Berita / Blog sederhana yang dibuat menggunakan **Laravel 12**, **Laravel Sanctum** untuk urusan token manajemen, dan **MySQL** sebagai databasenya.

Di dalam project ini sudah dipasang sistem keamanan **RBAC (Role-Based Access Control)** yang memisahkan hak akses antara akun `admin` (bisa mengelola semua data) dan akun `user` biasa (hanya bisa membaca data saja).

---

## Fitur Utama Aplikasi

1. **Autentikasi Token (Sanctum)**: Proses register dan login yang menghasilkan Bearer Token untuk mengamankan endpoint terproteksi.
2. **Sistem Keamanan RBAC**: Proteksi rute menggunakan middleware kustom `CheckAdmin`. Jika user biasa nekat menambah/mengubah berita, sistem otomatis memblokir dan mengembalikan error HTTP 403 Forbidden.
3. **Eager Loading Database**: Penarikan data artikel berita (`GET /api/posts`) sudah otomatis mengangkut data kategori dan nama penulisnya secara instan dari database.

---

## Langkah Instalasi & Cara Menjalankan Project

Bagi yang ingin menjalankan project ini di komputer lokal, silakan ikuti panduan berikut ini:

### 1. Ekstrak Berkas Project

Pastikan folder project hasil ekstrak file ZIP ini sudah diletakkan di dalam folder server lokal Anda, misalnya di `C:\laragon\www\` (bagi pengguna Laragon) atau di `C:\xampp\htdocs\` (bagi pengguna XAMPP).

## 2. Unduh Ulang Folder Vendor (Composer)

Karena folder `vendor` sengaja dihapus agar ukuran ZIP ringan, Anda harus mendownloadnya kembali. Buka terminal di VS Code pada folder project ini, lalu jalankan perintah:

```bash
composer install
```
### 3. Setup Konfigurasi File .env
Buka terminal di VS Code, lalu duplikat file contoh .env.example bawaan Laravel menjadi file .env utama menggunakan perintah ini:

```bash
cp .env.example .env
```
###
Buka file .env yang baru muncul tersebut di VS Code. File ini berfungsi untuk menyimpan setingan rahasia project kita (seperti koneksi database).

Cari baris kode yang berawalan DB_ (biasanya di sekitar baris ke-20 sampai ke-30), lalu sesuaikan isinya dengan setingan database di laptop Anda seperti contoh di bawah ini:

Cuplikan kode
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_blog_uts
DB_USERNAME=root
DB_PASSWORD=

Penjelasan Konfigurasi:
DB_DATABASE: Ini adalah nama database yang akan kita gunakan di MySQL nanti. Di sini kita sepakati namanya db_blog_uts.
DB_USERNAME: Default pengguna MySQL untuk XAMPP/Laragon biasanya adalah root.
DB_PASSWORD: Kosongkan saja (jangan diisi apa-apa setelah tanda =) jika Anda menggunakan setingan bawaan standar XAMPP/Laragon di Windows.
```
