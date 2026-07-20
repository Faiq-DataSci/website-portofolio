# Portfolio Website

Website portofolio profesional yang dibangun menggunakan **CodeIgniter 4** dengan bahasa pemrograman **PHP**. Proyek ini dirancang sebagai media untuk menampilkan profil, pengalaman, keterampilan, proyek, serta informasi kontak secara modern, responsif, dan mudah dikelola.

---

## 📖 Deskripsi

Website ini berfungsi sebagai identitas digital sekaligus media untuk mempresentasikan kemampuan, pengalaman, dan hasil karya dalam bidang pengembangan perangkat lunak, Data Science, Artificial Intelligence, serta teknologi informasi.

Pengembangan dilakukan menggunakan framework **CodeIgniter 4** yang menerapkan pola arsitektur **Model-View-Controller (MVC)** sehingga kode lebih terstruktur, mudah dipelihara, dan dapat dikembangkan di masa mendatang.

---

## ✨ Fitur

- Halaman Beranda (Home)
- Profil Singkat (About)
- Daftar Keahlian (Skills)
- Portofolio Proyek
- Pengalaman
- Riwayat Pendidikan
- Sertifikat
- Kontak
- Responsive Design
- Clean UI/UX
- Struktur MVC CodeIgniter 4
- Routing yang terstruktur
- Asset Management
- SEO Friendly

---

## 🛠️ Teknologi yang Digunakan

| Teknologi     | Keterangan               |
| ------------- | ------------------------ |
| PHP           | Bahasa pemrograman utama |
| CodeIgniter 4 | Framework Backend        |
| HTML5         | Struktur halaman         |
| CSS3          | Styling                  |
| JavaScript    | Interaktivitas           |
| Bootstrap     | Responsive Layout        |
| MySQL         | Database                 |
| Composer      | Dependency Manager       |
| Git           | Version Control          |

---

## 📂 Struktur Project

```
portfolio-website/
│
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   ├── Config/
│   └── Filters/
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   ├── images/
│   │   └── icons/
│   └── index.php
│
├── writable/
├── tests/
├── vendor/
├── .env
├── composer.json
└── README.md
```

---

## ⚙️ Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Apache / Nginx
- Git

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/portfolio.git
```

Masuk ke direktori project.

```bash
cd portfolio
```

---

### 2. Install Dependency

```bash
composer install
```

---

### 3. Salin File Environment

```bash
cp env .env
```

atau pada Windows

```bash
copy env .env
```

---

### 4. Konfigurasi Database

Edit file `.env`

```env
database.default.hostname = localhost
database.default.database = portfolio
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

### 5. Jalankan Migration (Jika Menggunakan Migration)

```bash
php spark migrate
```

---

### 6. Jalankan Server

```bash
php spark serve
```

Website dapat diakses melalui

```
http://localhost:8080
```

---

## 📌 Arsitektur

Project menerapkan pola **MVC (Model-View-Controller)**.

### Model

Mengelola interaksi dengan database.

### View

Menampilkan antarmuka pengguna.

### Controller

Menghubungkan Model dan View serta menangani logika aplikasi.

---

## 📱 Responsive Design

Website dirancang agar dapat berjalan dengan baik pada berbagai ukuran layar:

- Desktop
- Laptop
- Tablet
- Smartphone

---

## 📈 Tujuan Pengembangan

Website ini dibuat untuk:

- Menampilkan identitas profesional
- Menampilkan pengalaman kerja
- Menampilkan proyek yang telah dikerjakan
- Menampilkan kemampuan teknis
- Mempermudah rekruter atau klien mengenal profil pengembang

---

## 🔒 Keamanan

Beberapa fitur keamanan yang diterapkan:

- Validasi Input
- CSRF Protection
- XSS Filtering
- Routing CodeIgniter 4
- Environment Configuration
- Error Handling

---

## 📄 Lisensi

Project ini dibuat untuk keperluan pengembangan portofolio pribadi.

Silakan digunakan sebagai referensi pembelajaran. Apabila ingin menggunakan sebagian atau seluruh kode, mohon memberikan atribusi yang sesuai.

---

## 👨‍💻 Author

**Nama:** Faiq

**Tech Stack**

- PHP
- CodeIgniter 4
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap
- Git

---

## ⭐ Penutup

Terima kasih telah mengunjungi repositori ini.

Apabila Anda memiliki masukan, pertanyaan, atau ingin berkolaborasi, silakan menghubungi saya melalui halaman kontak pada website atau membuka issue pada repositori ini.
