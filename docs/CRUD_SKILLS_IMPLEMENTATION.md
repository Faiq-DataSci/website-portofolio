# CRUD Skills - Implementasi Lengkap

## 📋 Overview

Sistem CRUD Skills memungkinkan admin untuk mengelola skills yang ditampilkan di halaman frontend `/skills`. Admin dapat menambah, edit, dan hapus skills dengan kategori, level, icon, dan status.

---

## ✅ Status Implementasi

### **Yang Sudah Selesai:**

1. ✅ **Migration** - Tabel `skills` berhasil dibuat
2. ✅ **Model** - SkillModel dengan method lengkap
3. ✅ **Controller Admin** - CRUD operations dengan validasi
4. ✅ **Routes** - Semua route sudah terdaftar

### **Yang Perlu Dilakukan:**

4. 🔄 **View Admin Index** - Perlu update untuk empty state & dynamic data
5. 🔄 **View Admin Form** - Perlu update untuk field baru (level enum, description, order_index)
6. 🔄 **Controller Frontend** - Update untuk fetch dari database
7. 🔄 **View Frontend** - Update untuk dynamic data grouping by category

---

## 🗄️ Database Structure

### **Tabel: `skills`**

| Field | Type | Null | Default | Description |
|-------|------|------|---------|-------------|
| **id** | INT(11) unsigned | NO | AUTO | Primary key |
| **name** | VARCHAR(100) | NO | - | Nama skill (e.g: Python, React.js) |
| **category** | VARCHAR(50) | NO | - | Kategori (e.g: Programming, Framework, Database) |
| **level** | ENUM | NO | Intermediate | Level: Beginner, Intermediate, Advanced, Expert |
| **icon** | VARCHAR(100) | YES | NULL | Iconify icon name (e.g: logos:python) |
| **description** | TEXT | YES | NULL | Deskripsi skill |
| **order_index** | INT(11) | NO | 0 | Urutan tampilan (sorting) |
| **status** | ENUM | NO | active | Status: active, inactive |
| **created_at** | DATETIME | YES | NULL | Waktu dibuat |
| **updated_at** | DATETIME | YES | NULL | Waktu update |

**Indexes:**
- PRIMARY KEY (`id`)
- KEY (`category`)
- KEY (`status`)
- KEY (`order_index`)

---

## 🎯 Fitur CRUD

### **1. CREATE (Tambah Skill)**

**Route:** `GET /admin/skills/create`  
**Controller:** `Admin\Skills::create()`  
**View:** `admin/skills/form.php`

**Form Fields:**
- ✅ Name (required, 2-100 chars)
- ✅ Category (required, max 50 chars)
- ✅ Level (required, enum: Beginner|Intermediate|Advanced|Expert)
- ✅ Icon (optional, iconify icon name)
- ✅ Description (optional, max 500 chars)
- ✅ Order Index (optional, integer untuk sorting)
- ✅ Status (required, enum: active|inactive)

**Validation Rules:**
```php
'name'        => 'required|min_length[2]|max_length[100]',
'category'    => 'required|max_length[50]',
'level'       => 'required|in_list[Beginner,Intermediate,Advanced,Expert]',
'icon'        => 'permit_empty|max_length[100]',
'description' => 'permit_empty|max_length[500]',
'order_index' => 'permit_empty|integer',
'status'      => 'required|in_list[active,inactive]',
```

**Submit:** `POST /admin/skills/store`

---

### **2. READ (Lihat Skills)**

**Route:** `GET /admin/skills`  
**Controller:** `Admin\Skills::index()`  
**View:** `admin/skills/index.php`

**Statistik yang Ditampilkan:**
- 📊 Total Skills
- ✅ Active Skills
- ❌ Inactive Skills
- 📁 Total Categories

**Tabel Columns:**
- No
- Skill Name + Icon
- Category
- Level
- Status (badge: active=green, inactive=gray)
- Aksi (Edit, Delete)

**Empty State:**
- Icon folder besar
- Pesan: "Belum Ada Skill"
- Button: "Tambah Skill Pertama"

---

### **3. UPDATE (Edit Skill)**

**Route:** `GET /admin/skills/edit/{id}`  
**Controller:** `Admin\Skills::edit($id)`  
**View:** `admin/skills/form.php` (sama dengan create)

**Flow:**
1. Find skill by ID
2. If not found → redirect dengan error
3. Pre-fill form dengan data lama
4. User update data
5. Submit: `POST /admin/skills/update/{id}`

---

### **4. DELETE (Hapus Skill)**

**Route:** `GET /admin/skills/delete/{id}`  
**Controller:** `Admin\Skills::delete($id)`

**Flow:**
1. Find skill by ID
2. If found → Delete dari database
3. Redirect dengan flash message success/error

**Konfirmasi:**
- JavaScript confirm dengan nama skill
- "Apakah Anda yakin ingin menghapus skill '{nama}'?"

---

## 🎨 Level Badge Colors

Level skills menggunakan warna berbeda untuk visual indicator:

| Level | Color | Background | Text |
|-------|-------|------------|------|
| **Beginner** | Gray | #F5F5F5 | #666 |
| **Intermediate** | Blue | #E3F2FD | #1976D2 |
| **Advanced** | Orange | #FFF3E0 | #F57C00 |
| **Expert** | Green | #E8F5E9 | #388E3C |

---

## 📱 Frontend Integration

### **Controller: `Skills::index()`**

```php
public function index(): string
{
    $skillsGrouped = $this->skillModel->getSkillsByCategory();
    
    $data = [
        'title' => 'My Skills | Faiq Portfolio',
        'skillsGrouped' => $skillsGrouped,
    ];
    
    return view('skills/index', $data);
}
```

### **View: `skills/index.php`**

**Struktur:**
```php
<?php foreach ($skillsGrouped as $category => $skills): ?>
    <section class="skill-category">
        <h2><?= esc($category) ?></h2>
        
        <div class="skills-grid">
            <?php foreach ($skills as $skill): ?>
                <div class="skill-card">
                    <?php if ($skill['icon']): ?>
                        <iconify-icon icon="<?= esc($skill['icon']) ?>"></iconify-icon>
                    <?php endif; ?>
                    
                    <h3><?= esc($skill['name']) ?></h3>
                    <span class="level-badge <?= strtolower($skill['level']) ?>">
                        <?= esc($skill['level']) ?>
                    </span>
                    
                    <?php if ($skill['description']): ?>
                        <p><?= esc($skill['description']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>
```

---

## 🔧 Model Methods

### **`getSkills()`**
Get all skills ordered by order_index and id.

```php
$skills = $skillModel->getSkills();
// Returns: array of all skills
```

### **`getActiveSkills()`**
Get only active skills ordered by category and order_index.

```php
$skills = $skillModel->getActiveSkills();
// Returns: array of active skills only
```

### **`getSkillsByCategory()`**
Get active skills grouped by category.

```php
$grouped = $skillModel->getSkillsByCategory();
// Returns: [
//   'Programming' => [skill1, skill2, ...],
//   'Framework' => [skill3, skill4, ...],
//   ...
// ]
```

---

## 📝 Sample Data

### **Programming Skills:**
```sql
INSERT INTO skills (name, category, level, icon, description, order_index, status) VALUES
('Python', 'Programming', 'Expert', 'logos:python', 'Data Science, ML, Backend', 1, 'active'),
('JavaScript', 'Programming', 'Advanced', 'logos:javascript', 'Frontend & Backend Development', 2, 'active'),
('PHP', 'Programming', 'Advanced', 'logos:php', 'Backend Development with CodeIgniter', 3, 'active'),
('SQL', 'Programming', 'Advanced', 'vscode-icons:file-type-sql', 'Database Query & Management', 4, 'active');
```

### **Framework Skills:**
```sql
INSERT INTO skills (name, category, level, icon, description, order_index, status) VALUES
('React.js', 'Framework', 'Intermediate', 'logos:react', 'Frontend Library', 1, 'active'),
('CodeIgniter 4', 'Framework', 'Advanced', 'simple-icons:codeigniter', 'PHP Framework', 2, 'active'),
('TensorFlow', 'Framework', 'Intermediate', 'logos:tensorflow', 'Machine Learning', 3, 'active');
```

### **Tools:**
```sql
INSERT INTO skills (name, category, level, icon, description, order_index, status) VALUES
('Git', 'Tools', 'Advanced', 'logos:git-icon', 'Version Control', 1, 'active'),
('Docker', 'Tools', 'Intermediate', 'logos:docker-icon', 'Containerization', 2, 'active'),
('VS Code', 'Tools', 'Expert', 'logos:visual-studio-code', 'Code Editor', 3, 'active');
```

---

## 🚀 Quick Start Guide

### **1. Setup Database**
```bash
# Migration sudah dijalankan
php spark migrate
# Output: CreateSkillsTable migration complete
```

### **2. Insert Sample Data**
```bash
# Masuk ke MySQL
C:\xampp\mysql\bin\mysql.exe -u root portfolio

# Copy-paste SQL insert di atas
```

### **3. Akses Admin**
```
http://localhost:8080/admin/skills
```

### **4. Tambah Skill Pertama**
```
1. Klik "Tambah Skill"
2. Isi form:
   - Name: Python
   - Category: Programming
   - Level: Expert
   - Icon: logos:python
   - Description: Programming language untuk Data Science dan ML
   - Order Index: 1
   - Status: Active
3. Klik "Simpan"
```

### **5. Lihat di Frontend**
```
http://localhost:8080/skills
```

---

## ⚠️ Common Issues & Solutions

### **Error: Table 'skills' doesn't exist**
**Solution:**
```bash
php spark migrate
```

### **Skills tidak muncul di frontend**
**Solution:**
1. Cek status skill = "active"
2. Clear browser cache (Ctrl+Shift+R)
3. Cek Controller Skills frontend sudah update
4. Cek view frontend sudah dynamic

### **Icon tidak muncul**
**Solution:**
1. Pastikan Iconify script di-load:
   ```html
   <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
   ```
2. Cek nama icon valid di https://icon-sets.iconify.design/
3. Format: `logos:python` (collection:icon-name)

---

## 📊 Admin View Structure

```
admin/skills/
├── index.php         → List all skills dengan table
│   ├── Header (Title + Button "Tambah Skill")
│   ├── Statistics Cards (Total, Active, Inactive, Categories)
│   ├── Table (Skills list dengan aksi edit/delete)
│   └── Empty State (jika belum ada data)
│
└── form.php          → Form tambah/edit skill
    ├── Breadcrumb
    ├── Flash Messages
    ├── Form Fields:
    │   ├── Name (text input)
    │   ├── Category (select/text)
    │   ├── Level (select: Beginner|Intermediate|Advanced|Expert)
    │   ├── Icon (text input dengan preview)
    │   ├── Description (textarea)
    │   ├── Order Index (number input)
    │   └── Status (radio: active|inactive)
    └── Buttons (Simpan, Batal)
```

---

## 🎯 Next Steps

Untuk melengkapi implementasi, Anda perlu:

1. ✅ **Update View Admin Index** (`app/Views/admin/skills/index.php`)
   - Tambah empty state
   - Tampilkan data dari database
   - Badge level dengan warna
   - Konfirmasi delete

2. ✅ **Buat View Admin Form** (`app/Views/admin/skills/form.php`)
   - Form dengan field lengkap
   - Dropdown level (enum)
   - Icon preview
   - Validasi client-side

3. ✅ **Update Controller Frontend** (`app/Controllers/Skills.php`)
   - Fetch dari `getSkillsByCategory()`
   - Pass data ke view

4. ✅ **Update View Frontend** (`app/Views/skills/index.php`)
   - Loop skills grouped by category
   - Tampilkan icon dari iconify
   - Badge level dengan warna
   - Responsive grid

---

**Status:** 🚧 In Progress (4/8 tasks completed)  
**Next:** Update views untuk admin dan frontend  
**Version:** 1.0.0  
**Last Update:** 28 Juli 2026, 14:21 WIB
