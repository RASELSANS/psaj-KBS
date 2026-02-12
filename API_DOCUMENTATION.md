# 📚 Klinik Brayan Sehat API - Documentation & Usage Guide

## 📋 Daftar Isi
1. [Setup Postman](#setup-postman)
2. [Authentikasi](#authentikasi)
3. [Alur Penggunaan](#alur-penggunaan)
4. [Endpoint Reference](#endpoint-reference)
5. [Response Format](#response-format)
6. [Error Handling](#error-handling)

---

## 🔧 Setup Postman

### Step 1: Import Collection
1. Buka **Postman** aplikasi
2. Click **File** → **Import**
3. Select file: `Klinik_Brayan_Sehat_API.postman_collection.json`
4. Collection akan ter-import otomatis

### Step 2: Setup Environment (Optional tapi recommended)
1. Click **Environments** di sidebar kiri
2. Click **Create**
3. Isi environment variables:
```
base_url: http://localhost:8080
admin_id: (akan diisi otomatis setelah login)
```

Gunakan `{{base_url}}` di URL requests untuk kemudahan.

---

## 🔐 Authentikasi

### Login Admin
**Endpoint:** `POST /api/admin/login`

**Credentials Default:**
```
Username: admin
Password: admin123
```

**Request Body:**
```
username=admin&password=admin123
```

**Response Success:**
```json
{
  "status": true,
  "data": {
    "id_admin": 1,
    "username": "admin"
  }
}
```

**Session akan tersimpan otomatis di Postman/browser**, jadi endpoint admin berikutnya tidak perlu pass credentials lagi.

### Logout Admin
**Endpoint:** `POST /api/admin/logout`

Destroy session. Setelah ini, tidak bisa akses protected endpoints sampai login lagi.

---

## 🔄 Alur Penggunaan

### Untuk Public API (Tidak perlu login)
1. Langsung akses endpoint public:
   - `GET /api/doctors`
   - `GET /api/artikel`
   - `GET /api/jadwal?id_doctor=1`
   - dll

### Untuk Admin API (Perlu login)
1. **Step 1**: Run `POST /api/admin/login` dengan credentials
2. **Step 2**: Session tersimpan otomatis
3. **Step 3**: Akses protected endpoints `/api/admin/*`
4. **Step 4**: Setelah selesai, `POST /api/admin/logout`

---

## 📍 Endpoint Reference

### 🟢 PUBLIC ENDPOINTS

#### Dokter
```
GET  /api/doctors                    → List dokter (pagination)
GET  /api/doctors/:id                → Detail dokter + jadwal
```

**Response Contoh:**
```json
{
  "status": true,
  "data": [
    {
      "id_doctor": 1,
      "nama_doctor": "Dr. Ahmad",
      "profil": "Dokter spesialis anak",
      "foto": "doctor_1.jpg",
      "spesialis": [
        {
          "id_spesialis": 1,
          "nama_spesialis": "Anak-Anak"
        }
      ],
      "poli": [
        {
          "id_poli": 1,
          "nama_poli": "Poli Anak"
        }
      ]
    }
  ],
  "pagination": {
    "page": 1,
    "limit": 10,
    "total": 25,
    "total_pages": 3
  }
}
```

#### Spesialis
```
GET  /api/spesialis                  → List spesialis
```

#### Poli
```
GET  /api/poli                       → List poli
```

#### Jadwal
```
GET  /api/jadwal?id_doctor=1         → Jadwal dokter spesifik
```

#### Artikel
```
GET  /api/artikel                    → List artikel (pagination)
GET  /api/artikel/:id                → Detail artikel
```

---

### 🔵 ADMIN AUTHENTICATION

```
POST /api/admin/login                → Login
POST /api/admin/logout               → Logout
GET  /api/admin/profile              → Get admin profile (protected)
```

---

### 🟡 ADMIN CRUD ENDPOINTS (Protected)

#### Dokter
```
GET    /api/admin/doctors            → List dokter (pagination)
POST   /api/admin/doctors            → Create dokter
PUT    /api/admin/doctors/:id        → Update dokter
DELETE /api/admin/doctors/:id        → Delete dokter
```

**Create/Update Dokter - Form Data:**
```
nama_doctor: string (required)
profil: string (required)
foto: file (optional, max 2MB)
id_spesialis[]: array of int (required)
id_poli[]: array of int (required)
```

#### Spesialis
```
GET    /api/admin/spesialis          → List spesialis
POST   /api/admin/spesialis          → Create
PUT    /api/admin/spesialis/:id      → Update
DELETE /api/admin/spesialis/:id      → Delete
```

**Create/Update - Form Data:**
```
nama_spesialis: string (required)
```

#### Poli
```
GET    /api/admin/poli               → List poli
POST   /api/admin/poli               → Create
PUT    /api/admin/poli/:id           → Update
DELETE /api/admin/poli/:id           → Delete
```

**Create/Update - Form Data:**
```
nama_poli: string (required)
deskripsi: string (required)
```

#### Jadwal
```
GET    /api/admin/jadwal?id_doctor=1 → List jadwal
POST   /api/admin/jadwal             → Create
PUT    /api/admin/jadwal/:id         → Update
DELETE /api/admin/jadwal/:id         → Delete
```

**Create/Update - Form Data:**
```
id_doctor: int (required)
hari: string (required, contoh: "Senin-Jumat", "Rabu")
jam_mulai: time (required, format: HH:mm:ss)
jam_selesai: time (required, format: HH:mm:ss)
```

#### Artikel
```
GET    /api/admin/artikel            → List artikel (pagination)
POST   /api/admin/artikel            → Create
PUT    /api/admin/artikel/:id        → Update
DELETE /api/admin/artikel/:id        → Delete
```

**Create/Update - Form Data:**
```
judul: string (required)
isi: text (required)
tanggal_publish: date (required, format: YYYY-MM-DD)
thumbnail: file (optional, max 2MB)
```

---

## 📤 Response Format

### Success Response
```json
{
  "status": true,
  "data": {...}
}
```

### Validation Error
```json
{
  "status": false,
  "errors": {
    "field_name": "Error message",
    "another_field": "Error message"
  }
}
```

### Authentication Error
```json
{
  "status": false,
  "errors": {
    "auth": "Anda harus login terlebih dahulu"
  }
}
```

### Not Found Error
```json
{
  "status": false,
  "errors": {
    "dokter": "Dokter tidak ditemukan"
  }
}
```

---

## ⚠️ Error Handling

### Common HTTP Status Codes

| Code | Meaning | Contoh |
|------|---------|--------|
| **200** | OK | GET request berhasil, data ditemukan |
| **201** | Created | POST request berhasil, data dibuat |
| **400** | Bad Request | Validation error, format salah |
| **401** | Unauthorized | Tidak login / session expired |
| **404** | Not Found | Resource tidak ditemukan |
| **500** | Server Error | Error di server |

---

## 🧪 Testing Workflow

### Scenario 1: Testing Public API (Data Dokter)

**Step 1:** Get list dokter
```
GET /api/doctors?page=1
```

**Step 2:** Get dokter spesifik
```
GET /api/doctors/1
```

**Response akan include:**
- Detail dokter
- Spesialis yang dimiliki
- Poli tempat bekerja
- Jadwal kerja

### Scenario 2: Full Admin Workflow

**Step 1:** Login
```
POST /api/admin/login
Body: username=admin&password=admin123
```

**Step 2:** Create spesialis
```
POST /api/admin/spesialis
Body: nama_spesialis=Dokter Gigi
```

**Step 3:** Create poli
```
POST /api/admin/poli
Body: nama_poli=Poli Gigi&deskripsi=Pelayanan gigi
```

**Step 4:** Create dokter
```
POST /api/admin/doctors
Body: 
- nama_doctor: Dr. Bambang
- profil: Dokter gigi berpengalaman
- foto: [upload file]
- id_spesialis[]: 1
- id_poli[]: 1
```

**Step 5:** Create jadwal dokter
```
POST /api/admin/jadwal
Body:
- id_doctor: 1
- hari: Senin-Jumat
- jam_mulai: 09:00:00
- jam_selesai: 17:00:00
```

**Step 6:** Create artikel
```
POST /api/admin/artikel
Body:
- judul: Tips Kesehatan Gigi
- isi: [content]
- tanggal_publish: 2026-02-12
- thumbnail: [upload file]
```

**Step 7:** Logout
```
POST /api/admin/logout
```

---

## 📝 Important Notes

1. **File Upload:**
   - Max size: 2MB (dokter foto & artikel thumbnail)
   - Allowed types: JPG, PNG, GIF
   - Files disimpan di `public/uploads/doctors/` dan `public/uploads/articles/`

2. **Pagination:**
   - Default: 10 item per halaman
   - Parameter: `?page=1`, `?page=2`, dst

3. **Array Fields:**
   - Gunakan format `field[]` untuk multiple values
   - Contoh: `id_spesialis[]=1&id_spesialis[]=2`

4. **Session:**
   - Session otomatis tersimpan setelah login
   - Session expire otomatis (tergantung konfigurasi)
   - Logout menghapus session

5. **Base URL:**
   - Sesuaikan dengan domain/port Laragon Anda
   - Default: `http://localhost:8080`

---

## 🔗 Links

- **Postman Collection:** `Klinik_Brayan_Sehat_API.postman_collection.json`
- **Database:** `klinik_brayan_sehat`
- **Server:** CodeIgniter 4

---

**Good luck testing! 🚀**
