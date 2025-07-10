INVENTORY API
(REST API untuk manajemen inventori)

Version
- php : 8.2
- laravel : 12
- laravel/sanctum : 4.1

Cara menjalankan :
- Clone projek https://github.com/unfolks/inventory-api.git
- masuk ke direktori projek
- jalankan "composer install" untuk menginstall depedency
- jalankan "php artisan migrate --seed" untuk melakukan migrasi database dan memasukkan data user admin
- jalankan "php artisan serve"
- buka postman untuk mencobanya

DOKUMENTASI API

📦 Inventory API Documentation
Base URL: http://localhost:8000/api/
 
🔐 Authentication
Most endpoints require a Bearer Token in the Authorization header:
Authorization: Bearer <your_token>

🔑 Login
🔹 POST /login
Untuk mendapatkan Bearer Token.	
{
  "email": "user2@example.com",
  "password": "password"
}
Response:
{
  "token": "your_access_token"
}

🛒 Produk
🔹 GET /produk
Deskripsi: Ambil semua data produk.
Response: 200 OK
 
🔹 GET /produk/{id}
Deskripsi: Ambil detail produk berdasarkan ID.
Response: 200 OK
 
🔹 POST /produk
Deskripsi: Tambah produk baru.
Body (JSON):
{
  "nama_produk": "Baterai",
  "kode_produk": "PRD003",
  "kategori": "accecories",
  "satuan": "Pcs"
}
Response: 201 Created
 
🔹 PUT /produk/{id}
Deskripsi: Perbarui data produk.
Body (JSON):
{
  "nama_produk": "Baterai Alkaline ABC",
  "kode_produk": "PRD003",
  "kategori": "accecories",
  "satuan": "Pcs"
}
Response: 200 OK
 
🔹 DELETE /produk/{id}
Deskripsi: Hapus produk berdasarkan ID.
Response: 200 OK
 
🏠 Lokasi
🔹 GET /lokasi
Ambil semua data lokasi.
🔹 GET /lokasi/{id}
Ambil detail lokasi berdasarkan ID.
🔹 POST /lokasi
Tambah lokasi baru.
{
  "kode_lokasi": "LOC001",
  "nama_lokasi": "Gudang Utama"
}
🔹 PUT /lokasi/{id}
Perbarui lokasi.
{
  "kode_lokasi": "LOC002",
  "nama_lokasi": "Cabang 12"
}
🔹 DELETE /lokasi/{id}
Hapus lokasi berdasarkan ID.
 
👤 User
🔹 GET /user
Ambil semua user.
🔹 GET /user/{id}
Ambil detail user.
🔹 POST /user
Tambah user baru.
{
  "name": "Admin 2",
  "email": "admin2@example.com",
  "password": "password"
}
🔹 PUT /user/{id}
Update user.
{
  "name": "Admin23",
  "email": "admin23@example.com",
  "password": "password"
}
🔹 DELETE /user/{id}
Hapus user berdasarkan ID.
 
🔄 Mutasi
🔹 GET /mutasi/produk/{produk_id}
Lihat histori mutasi berdasarkan produk.
🔹 GET /mutasi/user/{user_id}
Lihat histori mutasi berdasarkan user.
🔹 POST /mutasi
Tambahkan mutasi (masuk atau keluar).
{
  "tanggal": "2025-07-09",
  "jenis_mutasi": "masuk", // atau "keluar"
  "jumlah": 8,
  "keterangan": "Penambahan stok awal",
  "produk_id": 2,
  "lokasi_id": 1
}
 
🧪 Tips Pengujian
- Gunakan Postman untuk menguji semua endpoint.
- Cek tab “Tests” untuk melihat hasil uji status 200 OK.
- Jangan lupa mengatur Authorization Bearer Token pada setiap request yang dibutuhkan.
