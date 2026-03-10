# Laporan Progress Phase 2.7: Admin Dashboard Development

Fase 2.7 difokuskan pada pengembangan antarmuka Manajemen Admin, mencakup Manajemen Pesanan (Orders), Manajemen Pelanggan (CRM), dan pembaruan pada Skema Promosi/Diskon spesifik untuk per-Trip, serta Revamp Dashboard Utama.

Berikut adalah rincian fungsionalitas yang telah berhasil diselesaikan:

---

## 1. Implementasi Order Management (Manajemen Pesanan)

Sistem telah dilengkapi dengan halaman riwayat dan detail pesanan yang memberikan wewenang penuh bagi pengelola Admin.

- **Admin/OrderController (@index, @show, @cancel)**
  Dibuatnya Controller khusus pesanan untuk menangani logika pengambilan data secara descending `(orderBy('created_at', 'desc'))`.
- **Fitur Filter & Search**
  Pencarian pesanan yang komprehensif mendukung filter menggunakan Status `(pending, paid, cancelled, refunded)` serta pencarian berbasis teks (Name, Email, Phone, & Order Number).
- **Detail Invoice & Pesanan**
  Halaman View (`resources/views/admin/orders/show.blade.php`) secara lengkap menampilkan profil pemesan, tabulasi semua peserta, Rincian Perjalanan berdasarkan `TripTemplate`, dan rekam biaya/billing dari varian harga hingga tambahan (addons). 
- **Pembatalan Ringkas (Manual Cancel)**
  Khusus pada pesanan tiket dengan status `pending`, Admin dapat melakukan pembatalan manual (Force Cancel) yang mengubah pesanan seketika menjadi `cancelled`.

## 2. Implementasi Customer Management (Manajemen Pelanggan / CRM)

Modul ini mentransformasi basis tabel `users` untuk melacak rekam jejak setiap pelanggan dengan optimal.

- **Admin/CustomerController (@index, @show)**
  Ditambahkan fungsionalitas _Customer Relationship Management (CRM)_. Dashboard membaca semua user dengan hak akses "user".
- **Akumulasi & Metrik Total Pembelanjaan**
  Melalui operasi Query Database secara efisien `(withSum dan withCount)`, Admin dapat langsung melihat agregasi performa setiap Customer di halaman utama meliputi *Total Order Terbayar* dan *Total Pengeluaran (Spend)*. 
- **Profil Detail Pelanggan**
  Halaman View (`resources/views/admin/customers/show.blade.php`) menyajikan Data Pribadi, Kontak Darurat (Emergency Contacts), beserta tebaran tabel list pesanan spesifik satu pelanggan.

## 3. Sistem Potongan Harga (Promo & Diskon per Open Trip)

Untuk mengakomodasi fleksibilitas harga promosi antar Open Trip dengan lebih presisi, arsitektur promo di-revamp dari _sistem Kupon Global_ menjadi _sistem Diskon tertanam (Embedded Discount)_ langsung pada level ***Departure Variants***.

- **Modifikasi Skema Database**
  Dilakukan migrasi database tabel `departure_variants` dengan menyuntikkan tiga kolom baru: 
  - `discount_type` (fixed / percent),
  - `discount_value` (integer rate/nilai pemotongan), 
  - `max_discount` (opsional untuk persentase diskon).
- **Pembaharuan Logika Model & Controller**
  Akses fungsi `getCalculatedDiscountAttribute()` di Model `DepartureVariant` secara cerdas mengonversi rate `percent` menjadi potongan angka nominal. Controller (`Admin/DepartureVariantController.php`) telah diperbarui agar selalu merekam input ini dari form admin.
- **Pembaruan View Admin & Checkout User**
  Form Tambah/Edit "Pricing Variant" kini menyematkan fields opsi Discount Type & Rate. Proses *Checkout* (`User/CheckoutController.php` & view `checkout/index.blade.php`) tidak memerlukan modifikasi karena secara bawaan menggunakan `$variant->calculated_discount;` yang merefleksikan nilai dari tabel secara _real-time_.

## 4. Revamp Dashboard Utama (Admin Dashboard)

Halaman utama Admin (`/admin/dashboard`) yang sebelumnya kosong kini telah diubah menjadi pusat informasi statistik _real-time_.

- **Admin/DashboardController**
  Controller baru untuk menghimpun data statistik vital.
- **Statistik Utama (KPI Cards)**
  Menampilkan:
  - **Total Revenue**: Pendapatan dari pesanan lunas.
  - **Total Orders**: Menyoroti pesanan aktif dan pending.
  - **Total Customers**: Pertumbuhan pelanggan.
  - **Active Trips**: Jumlah keberangkatan yang akan datang.
- **Tabel Pesanan Terbaru**
  Menyajikan 6 pesanan terakhir secara ringkas untuk pemantauan cepat.
- **Aksi Cepat (Quick Actions)**
  Shortcut tombol untuk membuat Trip baru, melihat Orders, atau ke Pengaturan.

## 5. Integrasi Routing & Sidebar (*adminMenu.json*)

Seluruh rute resource telah didaftarkan dalam `web.php` (Grup Middleware auth & role:admin). Selain itu, tab menu Sidebar vertikal secara resmi diperbarui di `resources/menu/adminMenu.json` untuk menampilkan opsi "Orders" dan "Customers" tepat di atas "Trip Management".

---

**Status Phase 2.7**: **COMPLETED**.
Fase 2 _(E-Commerce User Interactions)_ secara komprehensif dapat dikatakan telah rampung. Semua fitur fundamental (Booking, Payment Midtrans, Transaction, Wishlist, CRM, Order Management, Admin Dashboard) telah berjalan dengan baik.
