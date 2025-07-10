INVENTORY API
(REST API untuk manajemen inventori)

Version
- php : 8.2
- laravel : 12
- laravel/sanctum : 4.1

Cara menjalankan di local :
- Clone projek https://github.com/unfolks/inventory-api.git
- masuk ke direktori projek
- jalankan "composer install" untuk menginstall depedency
- jalankan "php artisan migrate --seed" untuk melakukan migrasi database dan memasukkan data user
- jalankan "php artisan serve"
- buka postman untuk mencobanya

Cara menjalankan di docker :
- pastikan docker sudah berjalan
- jalankan perintah "docker-compose up -d --build" untuk membuat container docker
- jalankan perintah "docker exec -it "Container-id-web" php artisan migrate --seed" untuk melakukan migrasi ke database dan memasukkan data user (masukkan container id tanpa tanda petik)
- buka di browser "localhost:8000" untuk melihat apakah sudah berjalan
- jika sudah berjalan maka bisa dilakukan pengetesan menggunakan postman / insomnia dsb

Import file json : 
- Import file inventory.postman_collection.json ke postman

DOKUMENTASI API
- cek dokumentasi api disini :
- https://app.swaggerhub.com/apis/ellcodes/inventory-api/1.0.0
