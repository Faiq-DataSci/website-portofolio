# Panduan CRUD Projects - Website Portofolio

## Setup Database

### 1. Jalankan Migration
Untuk membuat tabel `projects` di database, jalankan perintah:

```bash
php spark migrate
```

Ini akan membuat tabel `projects` dengan struktur:
- id (Primary Key)
- title (VARCHAR 255)
- description (TEXT)
- thumbnail (VARCHAR 255)
- github (VARCHAR 500)
- demo (VARCHAR 500)
- category (VARCHAR 100)
- status (ENUM: published, draft, archived)
- created_at (DATETIME)
- updated_at (DATETIME)

### 2. Pastikan Folder Upload Tersedia
Folder `public/uploads/projects/` sudah dibuat secara otomatis saat upload pertama kali.

---

## Fitur CRUD

### ✅ **CREATE (Tambah Project)**
1. Login ke admin panel
2. Akses menu **Project** 
3. Klik tombol **"Tambah Project"**
4. Isi form:
   - **Judul Project** (wajib, min 3 karakter)
   - **Deskripsi** (opsional, max 1000 karakter)
   - **Foto/Thumbnail** (opsional, max 2MB, format: jpg/jpeg/png)
   - **Link GitHub** (opsional, harus URL valid)
   - **Link Demo** (opsional, harus URL valid)
   - **Kategori** (wajib)
   - **Status** (wajib: Published/Draft/Archived)
5. Klik **"Simpan Project"**

✨ Project akan tersimpan dan muncul di halaman admin

### ✅ **READ (Lihat Project)**

**Di Admin:**
- Semua project ditampilkan di halaman `/admin/project`
- Statistik otomatis: Total, Published, Draft, Archived
- Filter dan search (coming soon)

**Di Frontend:**
- Hanya project dengan status **"Published"** yang muncul
- Akses halaman `/projects` untuk melihat
- Menampilkan thumbnail, judul, deskripsi, kategori, dan link GitHub/Demo

### ✅ **UPDATE (Edit Project)**
1. Di halaman admin Project, klik icon **Edit (pensil)** pada project yang ingin diedit
2. Form akan terisi dengan data lama
3. Ubah data yang diperlukan
4. Upload thumbnail baru jika perlu (thumbnail lama akan otomatis terhapus)
5. Klik **"Simpan Project"**

✨ Perubahan langsung tersimpan

### ✅ **DELETE (Hapus Project)**
1. Di halaman admin Project, klik icon **Delete (trash)** 
2. Konfirmasi penghapusan akan muncul dengan nama project
3. Klik **OK** untuk menghapus

⚠️ **Perhatian:** Penghapusan bersifat permanen. File thumbnail juga akan ikut terhapus dari server.

---

## Validasi Form

### Field yang Wajib Diisi:
- ✅ Judul Project (min 3 karakter)
- ✅ Kategori
- ✅ Status

### Validasi Upload Gambar:
- ✅ Format: JPG, JPEG, PNG
- ✅ Ukuran maksimal: 2MB
- ✅ Dimensi rekomendasi: 16:9 (misal: 1280x720px)

### Validasi URL:
- ✅ Link GitHub dan Demo harus format URL yang valid
- ✅ Contoh: `https://github.com/username/repo`

---

## Alur Integrasi Admin → Frontend

1. **Admin menambah project** → Data tersimpan ke database
2. **Set status = "Published"** → Project muncul di halaman `/projects`
3. **Set status = "Draft/Archived"** → Project tidak muncul di frontend

**Status Project:**
- 🟢 **Published**: Tampil di halaman publik
- 🟡 **Draft**: Tidak tampil (masih dalam pengembangan)
- ⚫ **Archived**: Tidak tampil (project lama/tidak aktif)

---

## Fitur Tambahan

### ✨ Auto-hide Flash Messages
Alert success/error akan otomatis hilang setelah 5 detik.

### ✨ Konfirmasi Delete
Nama project akan ditampilkan saat konfirmasi penghapusan untuk menghindari kesalahan.

### ✨ Empty State
Jika belum ada project yang dipublikasikan, akan muncul pesan "Belum Ada Project" di frontend.

### ✨ Drag & Drop Upload
Form tambah/edit project mendukung drag & drop untuk upload gambar.

---

## Troubleshooting

### ❌ Project tidak muncul di frontend
**Solusi:**
1. Pastikan status project = **"Published"**
2. Clear browser cache (Ctrl+Shift+R)
3. Cek database apakah data tersimpan

### ❌ Upload gambar gagal
**Solusi:**
1. Pastikan ukuran < 2MB
2. Pastikan format JPG/PNG
3. Cek permission folder `public/uploads/projects` (775)
4. Pastikan folder exists (auto-create on first upload)

### ❌ Tabel tidak ditemukan
**Solusi:**
```bash
php spark migrate
```

---

## Routes yang Tersedia

### Admin Routes (Butuh Login):
- `GET  /admin/project` - Daftar semua project
- `GET  /admin/project/create` - Form tambah project
- `POST /admin/project/store` - Simpan project baru
- `GET  /admin/project/edit/{id}` - Form edit project
- `POST /admin/project/update/{id}` - Update project
- `GET  /admin/project/delete/{id}` - Hapus project

### Frontend Routes (Public):
- `GET /projects` - Tampilkan semua published projects

---

## Tips Best Practices

1. ✅ Gunakan thumbnail dengan resolusi yang baik (min 1280x720px)
2. ✅ Tulis deskripsi yang jelas dan menarik (100-200 kata)
3. ✅ Sertakan link GitHub untuk menunjukkan source code
4. ✅ Sertakan link Demo untuk user trial
5. ✅ Gunakan kategori yang konsisten
6. ✅ Atur status dengan benar (Published untuk project jadi)

---

**Dibuat oleh:** Faiq  
**Tech Stack:** CodeIgniter 4, PHP, MySQL  
**Tanggal:** 28 Juli 2026
