# Troubleshooting: Gagal Menyimpan Project

## ❌ Error yang Muncul
```
Gagal menyimpan project. Silakan coba lagi.
```

---

## 🔍 Penyebab Masalah

### **Root Cause:**
- ❌ Konfigurasi database di `.env` belum diaktifkan (masih di-comment)
- ❌ Database `portfolio` belum dibuat
- ❌ Tabel `projects` belum ada (migration belum dijalankan)

---

## ✅ Solusi yang Sudah Dilakukan

### **1. Aktifkan Konfigurasi Database**

Edit file `.env` dan **uncomment** baris database:

```env
database.default.hostname = localhost
database.default.database = portfolio
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

**❗ Penting:** 
- Pastikan tidak ada `#` di depan baris
- Sesuaikan `username` dan `password` dengan setting MySQL Anda
- Untuk XAMPP default: username = `root`, password = `kosong`

---

### **2. Buat Database Portfolio**

**Via MySQL Command Line (XAMPP):**
```bash
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

**Via phpMyAdmin:**
1. Buka http://localhost/phpmyadmin
2. Klik tab "Databases"
3. Masukkan nama database: `portfolio`
4. Pilih collation: `utf8mb4_unicode_ci`
5. Klik "Create"

**Via SQL Script:**
```sql
CREATE DATABASE IF NOT EXISTS `portfolio` 
    DEFAULT CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;
```

---

### **3. Jalankan Migration**

Jalankan migration untuk membuat tabel `projects`:

```bash
php spark migrate
```

**Output yang benar:**
```
Running all new migrations...
    Running: (App) 2026-07-28-065000_App\Database\Migrations\CreateProjectsTable
Migrations complete.
```

---

### **4. Verifikasi Setup**

**Cek status migration:**
```bash
php spark migrate:status
```

**Output yang benar:**
```
+-----------+-------------------+---------------------+---------+---------------------+-------+
| Namespace | Version           | Filename            | Group   | Migrated On         | Batch |
+-----------+-------------------+---------------------+---------+---------------------+-------+
| App       | 2026-07-28-065000 | CreateProjectsTable | default | 2026-07-28 07:07:38 | 1     |
+-----------+-------------------+---------------------+---------+---------------------+-------+
```

**Cek struktur tabel:**
```bash
C:\xampp\mysql\bin\mysql.exe -u root portfolio -e "DESCRIBE projects;"
```

**Tabel harus memiliki field:**
- ✅ id (int, auto_increment, primary key)
- ✅ title (varchar 255)
- ✅ description (text)
- ✅ thumbnail (varchar 255)
- ✅ github (varchar 500)
- ✅ demo (varchar 500)
- ✅ category (varchar 100, default: 'Web Development')
- ✅ status (enum: published, draft, archived, default: 'published')
- ✅ created_at (datetime)
- ✅ updated_at (datetime)

---

## 🚀 Testing Setelah Fix

### **1. Test Tambah Project**
```
1. Akses: http://localhost:8080/admin/project/create
2. Isi form:
   - Judul: Test Project
   - Deskripsi: Ini adalah test project
   - Kategori: Web Development
   - Status: Published
3. Klik "Simpan Project"
4. Harus muncul: "Project 'Test Project' berhasil ditambahkan!"
5. Redirect ke halaman list projects
6. Project baru muncul di tabel
```

### **2. Cek Database**
```bash
C:\xampp\mysql\bin\mysql.exe -u root portfolio -e "SELECT * FROM projects;"
```

Harus menampilkan data project yang baru ditambahkan.

---

## ⚠️ Error Lain yang Mungkin Muncul

### **Error: "Access denied for user"**
```
Access denied for user 'root'@'localhost' (using password: NO)
```

**Solusi:**
- Cek username dan password MySQL di `.env`
- Pastikan MySQL XAMPP sudah running
- Coba set password:
  ```env
  database.default.password = your_password
  ```

---

### **Error: "Unknown database 'portfolio'"**
```
Unknown database 'portfolio'
```

**Solusi:**
- Database belum dibuat
- Jalankan perintah create database (lihat poin 2)

---

### **Error: "Table 'portfolio.projects' doesn't exist"**
```
Table 'portfolio.projects' doesn't exist
```

**Solusi:**
- Migration belum dijalankan
- Jalankan: `php spark migrate`

---

### **Error: "Unable to write file"**
```
Unable to write file: public/uploads/projects/xxx.jpg
```

**Solusi:**
- Folder `public/uploads/projects` tidak ada atau tidak writable
- Buat folder manual:
  ```bash
  New-Item -Path "public\uploads\projects" -ItemType Directory -Force
  ```
- Set permission (Windows): Klik kanan folder → Properties → Security → Full Control

---

## 📋 Checklist Setup Lengkap

Sebelum menggunakan fitur CRUD Projects, pastikan:

- [x] ✅ XAMPP MySQL sudah running
- [x] ✅ File `.env` sudah dikonfigurasi (database config uncomment)
- [x] ✅ Database `portfolio` sudah dibuat
- [x] ✅ Migration sudah dijalankan (`php spark migrate`)
- [x] ✅ Tabel `projects` sudah ada dan strukturnya benar
- [x] ✅ Folder `public/uploads/projects` sudah ada dan writable
- [x] ✅ Server PHP sudah running (`php spark serve`)

---

## 🎯 Quick Fix (Ringkasan)

```bash
# 1. Aktifkan config database di .env (edit manual)

# 2. Buat database
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 3. Jalankan migration
php spark migrate

# 4. Verifikasi
php spark migrate:status

# 5. Test tambah project
php spark serve
# Akses: http://localhost:8080/admin/project/create
```

---

## ✅ Status Sekarang

- ✅ **Database `portfolio` sudah dibuat**
- ✅ **Tabel `projects` sudah dibuat dengan struktur lengkap**
- ✅ **Migration berhasil dijalankan**
- ✅ **Konfigurasi database di `.env` sudah aktif**
- ✅ **Folder upload sudah tersedia**

**Sekarang Anda bisa menambah, edit, dan hapus project tanpa error!** 🎉

---

**Resolved:** 28 Juli 2026, 14:07 WIB  
**Duration:** ~5 menit  
**Issue:** Database configuration & setup
