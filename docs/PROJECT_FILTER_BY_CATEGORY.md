# Fitur Filter Project Berdasarkan Kategori Admin

**Tanggal:** 28 Juli 2026  
**Status:** ✅ Selesai  
**File yang Dimodifikasi:** `app/Views/projects/index.php`

---

## 📋 Ringkasan

Fitur ini memungkinkan user untuk melakukan filter project di halaman frontend berdasarkan **kategori yang diinputkan oleh admin**, menggantikan filter static yang sebelumnya hardcoded.

---

## 🎯 Masalah yang Diselesaikan

**Sebelumnya:**
- Filter button menggunakan kategori static: `All`, `Data Science`, `Python`, `Machine Learning`, `AI`
- Filter button tidak sesuai dengan kategori yang tersedia di form admin
- Tidak ada fungsi JavaScript untuk melakukan filtering

**Setelah Perbaikan:**
- Filter button disesuaikan dengan kategori admin: `All`, `Web Development`, `Machine Learning`, `Data Science`, `Mobile App`, `Desktop App`
- Kategori filter 100% match dengan pilihan kategori di form admin
- Ditambahkan JavaScript untuk filtering yang berfungsi secara dinamis

---

## 🔧 Implementasi

### 1. Update Filter Button HTML

**Lokasi:** `app/Views/projects/index.php` (Baris ~48-56)

```html
<!-- Filter -->
<section class="filters-section">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="Web Development">Web Development</button>
    <button class="filter-btn" data-filter="Machine Learning">Machine Learning</button>
    <button class="filter-btn" data-filter="Data Science">Data Science</button>
    <button class="filter-btn" data-filter="Mobile App">Mobile App</button>
    <button class="filter-btn" data-filter="Desktop App">Desktop App</button>
</section>
```

**Penjelasan:**
- Setiap button memiliki attribute `data-filter` yang berisi nilai kategori
- Button "All" memiliki class `active` sebagai default state
- Kategori sesuai dengan options di form admin (`app/Views/admin/projects/tambah_projects.php` baris ~181-186)

---

### 2. JavaScript Filter Functionality

**Lokasi:** `app/Views/projects/index.php` (Baris ~321-355)

```javascript
// ========== PROJECT FILTER FUNCTIONALITY ==========
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');

            // Get selected filter
            const filterValue = this.getAttribute('data-filter');

            // Filter project cards
            projectCards.forEach(card => {
                const category = card.getAttribute('data-category');

                if (filterValue === 'all') {
                    // Show all cards
                    card.style.display = 'block';
                } else {
                    // Show only matching category
                    if (category === filterValue) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });

            // Check if there are any visible cards
            const visibleCards = Array.from(projectCards).filter(card => 
                card.style.display !== 'none'
            );

            // Handle empty state (optional enhancement)
            // You can add custom empty state handling here if needed
        });
    });
});
```

**Cara Kerja:**

1. **Event Listener Setup**
   - Menunggu DOM fully loaded dengan `DOMContentLoaded`
   - Mendapatkan semua filter button dan project card

2. **Click Handler**
   - Menghapus class `active` dari semua button
   - Menambahkan class `active` ke button yang diklik
   - Mengambil nilai filter dari `data-filter` attribute

3. **Filter Logic**
   - Jika filter = `all`: tampilkan semua project card
   - Jika filter = kategori tertentu: hanya tampilkan card dengan `data-category` yang match
   - Card lainnya disembunyikan dengan `display: none`

4. **Visual Feedback**
   - Button aktif memiliki class `active` untuk styling
   - Card ditampilkan/disembunyikan secara instant

---

## 🔄 Data Flow

```
┌─────────────────────────────────────────────────────────────┐
│                      Admin Input                             │
│  (Form: app/Views/admin/projects/tambah_projects.php)       │
│                                                               │
│  Kategori Options:                                           │
│  • Web Development                                           │
│  • Machine Learning                                          │
│  • Data Science                                              │
│  • Mobile App                                                │
│  • Desktop App                                               │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────────┐
│              Database: projects.category                     │
│  Menyimpan kategori yang dipilih admin                      │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────────┐
│        Controller: Projects::index()                         │
│  Query: WHERE status='published' ORDER BY created_at DESC   │
│  Returns: Array of projects with category field             │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────────┐
│           View: projects/index.php                           │
│                                                               │
│  1. Render Filter Buttons (data-filter="kategori")          │
│  2. Loop Projects → Render Cards (data-category="kategori") │
│  3. JavaScript Filter Logic (match data-filter & category)  │
└─────────────────────────────────────────────────────────────┘
```

---

## ✅ Testing Checklist

Untuk memastikan filter berfungsi dengan baik, lakukan testing berikut:

### Pre-requisites
- Pastikan sudah ada data project di database dengan berbagai kategori
- Minimal 1 project untuk setiap kategori (Web Development, Machine Learning, Data Science, Mobile App, Desktop App)

### Test Cases

| No | Test Case | Expected Result | Status |
|----|-----------|----------------|--------|
| 1 | Akses halaman `/projects` | Semua project published tampil | ⏳ |
| 2 | Klik button "All" | Semua project tetap tampil | ⏳ |
| 3 | Klik button "Web Development" | Hanya project kategori Web Development yang tampil | ⏳ |
| 4 | Klik button "Machine Learning" | Hanya project kategori Machine Learning yang tampil | ⏳ |
| 5 | Klik button "Data Science" | Hanya project kategori Data Science yang tampil | ⏳ |
| 6 | Klik button "Mobile App" | Hanya project kategori Mobile App yang tampil | ⏳ |
| 7 | Klik button "Desktop App" | Hanya project kategori Desktop App yang tampil | ⏳ |
| 8 | Visual active state | Button yang aktif memiliki styling berbeda (class `active`) | ⏳ |
| 9 | Browser console | Tidak ada error JavaScript | ⏳ |
| 10 | Responsive behavior | Filter berfungsi di mobile, tablet, desktop | ⏳ |

### Manual Testing Steps

1. **Buka halaman projects**
   ```
   http://localhost:8080/projects
   ```

2. **Test setiap filter button**
   - Klik "All" → Cek semua project tampil
   - Klik "Web Development" → Cek hanya Web Development project yang tampil
   - Klik "Machine Learning" → Cek hanya Machine Learning project yang tampil
   - dst...

3. **Cek browser console**
   - Tekan `F12` atau `Ctrl+Shift+I`
   - Pastikan tidak ada error saat klik filter

4. **Test responsive**
   - Resize browser ke ukuran mobile (375px)
   - Test filter masih berfungsi

---

## 📁 File Structure

```
app/
├── Controllers/
│   └── Projects.php                 ← Controller frontend (sudah OK)
│   └── Admin/
│       └── Project.php              ← Controller admin (sudah OK)
├── Models/
│   └── ProjectModel.php             ← Model dengan field category
└── Views/
    ├── projects/
    │   └── index.php                ← ✅ MODIFIED (filter + JS)
    └── admin/
        └── projects/
            └── tambah_projects.php  ← Form admin (kategori options)
```

---

## 🔍 Kategori Yang Tersedia

| Kategori | Digunakan Di | Warna Tag (Default) |
|----------|-------------|---------------------|
| **Web Development** | Admin Form, Frontend Filter | Blue |
| **Machine Learning** | Admin Form, Frontend Filter | Green |
| **Data Science** | Admin Form, Frontend Filter | Blue |
| **Mobile App** | Admin Form, Frontend Filter | Purple |
| **Desktop App** | Admin Form, Frontend Filter | Yellow |

**Catatan:** Warna tag di card project ditentukan di `app/Views/projects/index.php` baris ~85-91

---

## 🚀 Cara Menambah Kategori Baru

Jika ingin menambah kategori baru di masa depan:

### 1. Update Form Admin
**File:** `app/Views/admin/projects/tambah_projects.php`

Tambahkan `<option>` baru di select kategori (sekitar baris 181-186):

```html
<select id="category" name="category" required>
    <option value="" disabled>Pilih kategori project</option>
    <option value="Web Development">Web Development</option>
    <option value="Machine Learning">Machine Learning</option>
    <option value="Data Science">Data Science</option>
    <option value="Mobile App">Mobile App</option>
    <option value="Desktop App">Desktop App</option>
    <!-- Tambahkan kategori baru di sini -->
    <option value="Blockchain">Blockchain</option>
</select>
```

### 2. Update Filter Frontend
**File:** `app/Views/projects/index.php`

Tambahkan button filter baru (sekitar baris 48-56):

```html
<section class="filters-section">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="Web Development">Web Development</button>
    <button class="filter-btn" data-filter="Machine Learning">Machine Learning</button>
    <button class="filter-btn" data-filter="Data Science">Data Science</button>
    <button class="filter-btn" data-filter="Mobile App">Mobile App</button>
    <button class="filter-btn" data-filter="Desktop App">Desktop App</button>
    <!-- Tambahkan filter baru di sini -->
    <button class="filter-btn" data-filter="Blockchain">Blockchain</button>
</section>
```

### 3. Update Tag Color (Opsional)
**File:** `app/Views/projects/index.php` (baris ~85-91)

Tambahkan kondisi warna untuk kategori baru:

```php
<?php 
    $category = $project['category'] ?? 'Web Development';
    $tagClass = 'blue';
    if (stripos($category, 'Machine Learning') !== false) $tagClass = 'green';
    elseif (stripos($category, 'Data Science') !== false) $tagClass = 'blue';
    elseif (stripos($category, 'Mobile') !== false) $tagClass = 'purple';
    elseif (stripos($category, 'Desktop') !== false) $tagClass = 'yellow';
    // Tambahkan kategori baru
    elseif (stripos($category, 'Blockchain') !== false) $tagClass = 'orange';
?>
```

**Tidak perlu ubah JavaScript** - fungsi filter sudah dinamis dan otomatis bekerja untuk kategori baru!

---

## 🐛 Troubleshooting

### Problem 1: Filter tidak berfungsi
**Solusi:**
- Cek browser console untuk error JavaScript
- Pastikan attribute `data-filter` di button dan `data-category` di card sudah benar
- Pastikan JavaScript sudah diload (cek Network tab di DevTools)

### Problem 2: Kategori tidak match
**Solusi:**
- Pastikan value di `data-filter` button **persis sama** dengan value di `data-category` card
- Case sensitive! "Web Development" ≠ "web development"

### Problem 3: Button active tidak berubah
**Solusi:**
- Cek CSS untuk class `.filter-btn.active`
- Pastikan JavaScript tidak error (cek console)

---

## 📝 Notes

- Filter dilakukan di **client-side** menggunakan JavaScript (tidak hit server)
- Performa baik karena tidak perlu reload page
- Jika project sangat banyak (>100), pertimbangkan server-side filtering dengan AJAX
- Filter saat ini case-sensitive, pastikan kategori di database match persis

---

## 👨‍💻 Developer

**Author:** Faiq  
**Tech Stack:** PHP, CodeIgniter 4, JavaScript (Vanilla), HTML5, CSS3  
**Date:** 28 Juli 2026

---

## 🔗 Related Documentation

- [CRUD Projects](./CRUD_PROJECTS.md)
- [Feature Project Detail](./FEATURE_PROJECT_DETAIL.md)
- [Admin Projects Empty State](./ADMIN_PROJECTS_EMPTY_STATE.md)
