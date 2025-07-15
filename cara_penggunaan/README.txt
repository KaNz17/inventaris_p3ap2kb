
SISTEM INFORMASI INVENTARIS BARANG
==================================

📌 DESKRIPSI:
Aplikasi ini digunakan untuk mendata barang-barang inventaris kantor, dilengkapi dengan fitur manajemen kategori, pencarian, laporan PDF & Excel, serta grafik statistik.

👨‍💻 FITUR UTAMA:
1. Login Multi User (Admin & Staff)
2. CRUD Data Barang & Kategori
3. Pencarian & Filter Data Barang
4. Cetak PDF Laporan Inventaris
5. Export ke Excel (XLS)
6. Grafik Statistik Barang per Kategori

🧪 AKUN LOGIN (default):
- Admin:  Username: admin   | Password: admin123
- Staff:  Username: staff   | Password: staff123

📂 STRUKTUR FOLDER:
- index.php           → Halaman Login
- dashboard.php       → Menu utama setelah login
- barang/             → CRUD Barang
- kategori/           → CRUD Kategori
- laporan/            → Cetak PDF & Export Excel
- statistik.php       → Grafik jumlah barang per kategori
- login/              → Proses login/logout
- config/koneksi.php  → Koneksi database
- database/inventaris.sql → Struktur + data awal DB

🛠 PERSYARATAN SISTEM:
- PHP 7.4+ dengan ekstensi zip
- MySQL
- Composer
- Dompdf (sudah include)

⚙ CARA INSTALL:
1. Jalankan XAMPP, aktifkan Apache & MySQL
2. Import database dari `database/inventaris.sql` ke phpMyAdmin
3. Buka folder di browser: `http://localhost/inventaris_bootstrap`
4. Login sebagai admin / staff

🧾 LISENSI:
Bebas digunakan untuk keperluan pembelajaran atau CPNS. Silakan modifikasi sesuai kebutuhan.

📬 KONTAK:
Dibuat bersama ChatGPT & Anda — semoga bermanfaat! 😊
