# 🚀 Deploy Laravel ke cPanel - Monti Outdoor Service

Panduan lengkap deploy aplikasi Laravel 11 (Monti Outdoor Service) ke shared hosting cPanel.

---

## 📋 Persiapan Sebelum Deploy

### 1. Build Production Assets
```bash
cd /Users/renoldnatasasmita/Dev/MontiOutdoor/monti-outdoor-service

# Install dependencies
npm install
composer install --optimize-autoloader --no-dev

# Build production assets
npm run build
```

### 2. Optimize Laravel
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📦 File & Folder yang Perlu di-Upload

### **SEMUA folder/file kecuali:**
❌ `node_modules/` (jangan upload!)
❌ `.git/` (jangan upload!)
❌ `tests/` (opsional, bisa skip)
❌ `.env` (buat baru di server)

### ✅ **Yang HARUS di-upload:**
```
/monti-outdoor-service/
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── lang/
├── public/              ← Ini akan jadi document root
│   ├── build/           ← Hasil npm run build
│   ├── images/
│   ├── css/
│   └── index.php
├── resources/
├── routes/
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
├── vendor/              ← Hasil composer install
├── .htaccess
├── artisan
├── composer.json
├── composer.lock
└── package.json
```

---

## 🗜️ Cara Membuat ZIP untuk Upload

### Menggunakan Terminal:
```bash
cd /Users/renoldnatasasmita/Dev/MontiOutdoor

# Buat ZIP tanpa file yang tidak perlu
zip -r monti-outdoor-production.zip monti-outdoor-service \
  -x "*/node_modules/*" \
  -x "*/.git/*" \
  -x "*/tests/*" \
  -x "*/.env"

# File hasil: monti-outdoor-production.zip
```

### Atau Manual (Finder):
1. Copy folder `monti-outdoor-service`
2. Hapus folder: `node_modules/`, `.git/`, `tests/`
3. Hapus file: `.env`
4. Compress folder → ZIP

---

## 🌐 Setup di cPanel

### **Step 1: Upload Files**

1. Login ke **cPanel**
2. Buka **File Manager**
3. Masuk ke folder `public_html` (atau subdomain folder)
4. Upload file `monti-outdoor-production.zip`
5. Extract ZIP di sana
6. **Pindahkan semua isi folder `monti-outdoor-service/` ke root**

**Struktur akhir di cPanel:**
```
/home/username/public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/              ← Document root nanti di sini
├── resources/
├── routes/
├── storage/
├── vendor/
└── ...
```

---

### **Step 2: Set Document Root**

1. Di cPanel, buka **Domains** atau **Addon Domains**
2. Edit domain/subdomain yang digunakan
3. Ubah **Document Root** ke:
   ```
   /home/username/public_html/public
   ```
4. Save

---

### **Step 3: Setup Database**

#### A. Buat Database di cPanel

1. Buka **MySQL Database Wizard** atau **MySQL Databases**
2. Buat database baru:
   - Database name: `username_monti`
3. Buat user baru:
   - Username: `username_monti_user`
   - Password: *buat password kuat*
4. Assign user ke database dengan **ALL PRIVILEGES**
5. **Catat info berikut:**
   ```
   DB_DATABASE=username_monti
   DB_USERNAME=username_monti_user
   DB_PASSWORD=your_password_here
   DB_HOST=localhost
   ```

#### B. Import Database (jika ada)

1. Buka **phpMyAdmin**
2. Pilih database `username_monti`
3. Tab **Import**
4. Upload file SQL dump (jika ada)
5. Execute

---

### **Step 4: Setup Environment (.env)**

1. Di **File Manager**, masuk ke root folder aplikasi
2. Copy file `.env.example` → rename jadi `.env`
3. Edit file `.env`:

```env
APP_NAME="Monti Outdoor Service"
APP_ENV=production
APP_KEY=                          # Akan generate nanti
APP_DEBUG=false                   # PENTING: false di production!
APP_URL=https://yourdomain.com    # URL website

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=pgsql               # Atau mysql jika pakai MySQL
DB_HOST=localhost
DB_PORT=5432                      # 3306 untuk MySQL
DB_DATABASE=username_monti
DB_USERNAME=username_monti_user
DB_PASSWORD=your_password_here

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# JWT Secret (generate nanti)
JWT_SECRET=

# Jangan lupa sesuaikan email settings jika ada
```

---

### **Step 5: Set Permissions**

Di **File Manager** atau via **Terminal** (jika ada SSH):

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
```

**Via File Manager:**
1. Klik kanan folder `storage/` → **Change Permissions**
2. Set **755** (drwxr-xr-x) recursive
3. Ulangi untuk `bootstrap/cache/`

---

### **Step 6: Generate APP_KEY & JWT_SECRET**

#### **Jika ada SSH Access:**
```bash
cd /home/username/public_html

# Generate APP_KEY
php artisan key:generate

# Generate JWT_SECRET (jika pakai JWT)
php artisan jwt:secret
```

#### **Jika TIDAK ada SSH:**
1. Buka https://generate-random.org/laravel-key-generator
2. Copy **Base64** key yang dihasilkan
3. Paste ke `.env`:
   ```
   APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx
   ```
4. Untuk JWT_SECRET, gunakan generator online atau buat manual:
   ```bash
   # Di local, jalankan ini dan copy hasilnya:
   php artisan jwt:secret --show
   ```

---

### **Step 7: Run Migrations**

#### **Jika ada SSH:**
```bash
cd /home/username/public_html

# Run migrations
php artisan migrate --force

# Seed data (opsional)
php artisan db:seed --force
```

#### **Jika TIDAK ada SSH:**
1. Buat file PHP temporary di `public/migrate.php`:
```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('migrate', ['--force' => true]);
echo "Migration completed!";
```
2. Akses: `https://yourdomain.com/migrate.php`
3. **HAPUS file ini setelah selesai!**

---

### **Step 8: Setup Storage Link**

Buat symbolic link untuk storage:

#### **Jika ada SSH:**
```bash
php artisan storage:link
```

#### **Jika TIDAK ada SSH:**
1. Buat file `public/storage-link.php`:
```php
<?php
$target = '/home/username/public_html/storage/app/public';
$link = '/home/username/public_html/public/storage';

if (!file_exists($link)) {
    symlink($target, $link);
    echo "Storage link created!";
} else {
    echo "Storage link already exists!";
}
```
2. Akses: `https://yourdomain.com/storage-link.php`
3. **HAPUS file ini setelah selesai!**

---

## ✅ Verifikasi Deployment

### Test Website:
1. Akses: `https://yourdomain.com`
2. Test halaman:
   - `/` (landing page)
   - `/login`
   - `/register`
   - `/admin/dashboard` (setelah login)

### Check Logs jika ada error:
- `storage/logs/laravel.log`

---

## 🔧 Troubleshooting

### ❌ Error 500 - Internal Server Error

**Penyebab umum:**
1. `.env` tidak ada atau salah konfigurasi
2. Storage permissions salah
3. APP_KEY belum di-generate

**Fix:**
```bash
# Set permissions
chmod -R 755 storage bootstrap/cache

# Regenerate key (SSH)
php artisan key:generate
```

---

### ❌ CSS/JS tidak load

**Penyebab:** Asset belum di-build atau path salah

**Fix:**
1. Pastikan sudah run `npm run build` sebelum upload
2. Cek folder `public/build/` ada dan berisi files
3. Cek `APP_URL` di `.env` sesuai domain

---

### ❌ Database connection error

**Check:**
1. Credentials di `.env` benar
2. Database sudah dibuat di cPanel
3. User sudah di-assign ke database
4. `DB_HOST` = `localhost` (bukan IP)

---

### ❌ Routes tidak work (404 selain homepage)

**Penyebab:** `.htaccess` tidak work atau document root salah

**Fix:**
1. Pastikan document root di cPanel: `/public`
2. Cek file `.htaccess` ada di folder `public/`
3. Content `.htaccess`:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

---

## 📝 Post-Deployment Checklist

- [ ] Website accessible
- [ ] Login/Register works
- [ ] Admin dashboard accessible
- [ ] Database connected
- [ ] Images uploading works (storage link)
- [ ] CSS/JS loaded correctly
- [ ] `.env` configured (APP_DEBUG=false)
- [ ] Migrations run successfully
- [ ] **Hapus file temporary** (migrate.php, storage-link.php)
- [ ] Test all functionality

---

## 🔐 Security Checklist

- [ ] `APP_DEBUG=false` di production
- [ ] `APP_ENV=production`
- [ ] `.env` permissions: 644
- [ ] Hapus/disable route `/migrate.php` jika ada
- [ ] Pastikan folder `storage/` tidak publicly accessible
- [ ] Setup SSL/HTTPS
- [ ] Backup database regularly

---

## 📞 Support

Jika ada masalah deployment:
1. Check `storage/logs/laravel.log`
2. Enable debug temporary: `APP_DEBUG=true` (jangan lupa disable lagi!)
3. Check browser console untuk error JS/CSS

---

**Good luck! 🚀**
