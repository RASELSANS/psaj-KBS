# Admin Redesign Blueprint - Comprehensive Documentation

**Date Created:** February 15, 2026  
**Status:** Ready for Implementation  
**Token Usage:** Documented before token limit reached

---

## 🎯 PROJECT OVERVIEW

### Objective

Rombak design semua halaman admin (dashboard, dokter, spesialis, poli, jadwal, artikel, login) dengan:

- Sidebar navigation (kiri desktop, atas mobile)
- Toggle hamburger menu untuk mobile
- Modal CRUD untuk dokter/spesialis/poli/jadwal
- Separate pages untuk artikel (add/edit)
- Image gallery management
- Search + Filter functionality
- Dashboard dengan jadwal harian slider
- New color palette: #ff8a3d (orange) + #1a1a1a (dark) + white

---

## 🎨 DESIGN SPECIFICATIONS

### Color Palette

```
Primary Orange:    #ff8a3d
Dark Background:   #1a1a1a
Dark Text:         #333
Light Gray:        #f8f9fa
Border Gray:       #e9ecef
White:             #ffffff
Success:           #4CAF50
Danger:            #e74c3c
Warning:           #ff9800
Info:              #2196F3
```

### Typography

- Font Family: Poppins (already imported)
- Font Sizes:
  - Headings: 2.5rem (h1), 2rem (h2), 1.5rem (h3)
  - Body: 1rem, 0.9rem (small)
  - Labels: 0.875rem

### Spacing

- Container padding: 1.5rem
- Card padding: 2rem
- Gap between items: 1.5rem
- Border radius: 20px (cards), 12px (buttons), 50px (rounded buttons)

### Hover Effects (dari landing_page)

- Cards: `transform: translateY(-5px)` + shadow increase
- Buttons: color darken + smooth transition
- Links: color change + underline
- Transition: `0.3s ease`

---

## 📁 FILE STRUCTURE - YANG PERLU DIBUAT/DIUBAH

### Files to CREATE:

```
app/Views/admin/
├── sidebar.php                    # Reusable sidebar component
├── new_layout.php                 # NEW base layout (replace layout.php)
├── gallery.php                    # NEW image gallery page
├── artikel_form.php               # NEW artikel form page (create/edit)
├── jadwal_regular.php             # NEW jadwal biasa page (rename dari jadwal.php)
├── jadwal_khusus.php              # NEW jadwal khusus page (phase 5)

app/Controllers/Admin/
├── GalleryController.php           # NEW image gallery CRUD
```

### Files to UPDATE:

```
app/Views/admin/
├── dashboard.php                  # Redesign dengan sidebar, stats kecil, jadwal slider
├── login.php                      # Match new design
├── dokter.php                     # Use new_layout + modal CRUD + search/filter
├── spesialis.php                  # Use new_layout + modal CRUD
├── poli.php                       # Use new_layout + modal CRUD + filter
├── jadwal.php                     # Convert to jadwal_regular.php

app/Controllers/Admin/
├── AdminController.php            # Add new view methods
```

---

## 🛠️ IMPLEMENTATION STEPS (Urutan Priority)

### PHASE 1: Layout Foundation (Part 1)

- [ ] Create `app/Views/admin/sidebar.php` (component)
- [ ] Create `app/Views/admin/new_layout.php` (base layout dengan sidebar)
- [ ] Update CSS styling untuk mobile responsiveness
- [ ] Test responsive breakpoints

### PHASE 2: Dashboard Redesign (Part 2)

- [ ] Update `app/Views/admin/dashboard.php`
  - Stats cards (kecil) - dokter, spesialis, poli, artikel
  - Left section: "Halo [Nama Admin]" greeting card
  - Right section: Calendar picker + jadwal harian list
  - Same height layout (grid/flex)

### PHASE 3: CRUD Pages - Modal Based (Part 3)

- [ ] Update `app/Views/admin/dokter.php`
  - Modal CRUD (create/edit/delete)
  - Search input (real-time filter)
  - Filter dropdowns: spesialis, poli, hari
  - Table dengan hover effects
- [ ] Update `app/Views/admin/spesialis.php`
  - Modal CRUD
- [ ] Update `app/Views/admin/poli.php`
  - Modal CRUD
  - Filter: spesialis
- [ ] Create `app/Views/admin/jadwal_regular.php` (rename dari jadwal.php)
  - Modal CRUD
  - Filter: dokter, hari

### PHASE 4: Artikel Pages (Part 4)

- [ ] Create `app/Views/admin/artikel_form.php` (create/edit form page)
- [ ] Update `app/Views/admin/artikel.php` (list only)
  - Search + filter
  - Link ke create/edit form

### PHASE 5: Image Gallery (Part 5)

- [ ] Create `app/Controllers/Admin/GalleryController.php`
- [ ] Create `app/Views/admin/gallery.php`
  - View images dari /public/uploads/
  - Delete image functionality
  - Upload new image form
  - Error handling kalau image di delete (placeholder di dokter/artikel)

### PHASE 6: Update Routes & Controller (Throughout)

- [ ] Update `app/Config/Routes.php` (add new routes)
- [ ] Update `app/Controllers/Admin/AdminController.php` (add view methods)

### PHASE 7: Jadwal Khusus (LATER - Phase 5)

- [ ] Create migration: `CreateJadwalKhususTable.php`
- [ ] Create model: `app/Models/JadwalKhusus.php`
- [ ] Create controller: `app/Controllers/Admin/JadwalKhususController.php`
- [ ] Create `app/Views/admin/jadwal_khusus.php`

---

## 📐 LAYOUT ARCHITECTURE

### Desktop Layout (1024px+)

```
┌─────────────────────────────────────────┐
│           TOP NAVBAR (sticky)           │
├──────────┬──────────────────────────────┤
│          │                              │
│ SIDEBAR  │      MAIN CONTENT            │
│ (fixed)  │      (scrollable)            │
│          │                              │
│ 250px    │      calc(100% - 250px)     │
│          │                              │
└──────────┴──────────────────────────────┘
```

### Mobile Layout (<1024px)

```
┌──────────────────────────────┐
│ ☰ NAVBAR (top, sticky)       │
├──────────────────────────────┤
│          SIDEBAR             │
│    (toggle/drawer)           │
├──────────────────────────────┤
│      MAIN CONTENT            │
│     (full width)             │
│                              │
└──────────────────────────────┘
```

---

## 🧩 CODE PATTERNS & REUSABLE COMPONENTS

### 1. NEW LAYOUT STRUCTURE

```php
<?= $this->extend('admin/new_layout'); ?>
<?= $this->section('admin_content'); ?>
  <!-- Main content here -->
<?= $this->endSection(); ?>
<?= $this->section('admin_scripts'); ?>
  <!-- Page-specific scripts -->
<?= $this->endSection(); ?>
```

### 2. SEARCH + FILTER PATTERN

```html
<div class="filter-bar">
  <input type="text" id="searchInput" placeholder="Cari..." class="search-input" />
  <select id="filterSpesialis" class="filter-select">
    <option value="">-- Semua Spesialis --</option>
    <!-- options -->
  </select>
  <button onclick="applyFilters()" class="btn-search">Cari</button>
</div>
```

```javascript
async function applyFilters() {
  const search = document.getElementById("searchInput").value;
  const filter = document.getElementById("filterSelect").value;

  const url = new URL(`${API_URL}/dokter`);
  if (search) url.searchParams.append("search", search);
  if (filter) url.searchParams.append("filter", filter);

  const response = await fetch(url);
  const data = await response.json();
  // Update table
}
```

### 3. EMPTY STATE PATTERN

```html
<div id="emptyState" class="empty-state" style="display: none;">
  <i class="fas fa-inbox" style="font-size: 60px; color: #ccc; margin-bottom: 20px;"></i>
  <p style="color: #999; font-size: 1rem;">Ups, data dokter belum ada</p>
  <button onclick="openAddModal()" class="btn-add" style="margin-top: 20px;">Tambah Data Pertama</button>
</div>
```

### 4. MODAL CRUD PATTERN

```javascript
async function openAddModal() {
  await loadOptions(); // Load dropdowns
  resetForm();
  new bootstrap.Modal(document.getElementById("entityModal")).show();
}

function resetForm() {
  document.getElementById("form").reset();
  document.getElementById("entityID").value = "";
  document.getElementById("modalTitle").textContent = "Tambah Data";
}

async function saveEntity(e) {
  e.preventDefault();
  const formData = new FormData(form);
  const id = document.getElementById("entityID").value;
  const url = id ? `${API_URL}/${id}` : API_URL;
  const method = id ? "PUT" : "POST";

  try {
    const response = await fetch(url, { method, body: formData });
    const data = await response.json();

    if (data.status) {
      showAlert("Berhasil!", "success");
      bootstrap.Modal.getInstance(modal).hide();
      loadData();
    } else {
      showAlert(Object.values(data.errors).join(", "), "danger");
    }
  } catch (error) {
    showAlert("Terjadi kesalahan", "danger");
  }
}
```

### 5. PAGINATION PATTERN (ARTIKEL)

```javascript
let currentPage = 1;
let totalPages = 1;

async function loadArtikel(page = 1) {
  const response = await fetch(`${API_URL}/artikel?page=${page}`);
  const data = await response.json();

  if (data.status) {
    // Render
    totalPages = data.data.pagination.total_pages;
    updatePaginationUI();
  }
}

function updatePaginationUI() {
  document.getElementById("prevBtn").classList.toggle("disabled", currentPage === 1);
  document.getElementById("nextBtn").classList.toggle("disabled", currentPage === totalPages);
  document.getElementById("pageInfo").textContent = `Page ${currentPage}`;
}
```

---

## 📋 UI COMPONENTS TO BUILD

### Alert Component

```javascript
function showAlert(message, type = "info") {
  // Bootstrap alert: success, danger, warning, info
  const alertHTML = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `;
  document.getElementById("alertContainer").innerHTML = alertHTML;
  setTimeout(() => {
    const alert = document.querySelector(".alert");
    if (alert) alert.classList.remove("show");
  }, 5000);
}
```

### Loading Spinner

```html
<div class="text-center py-5">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <p class="mt-3 text-muted">Memuat data...</p>
</div>
```

### Filter Bar

```html
<div class="filter-bar mb-4" style="display: flex; gap: 1rem; flex-wrap: wrap;">
  <input type="text" id="searchInput" placeholder="Cari..." class="form-control" style="flex: 1; min-width: 200px;" />
  <select id="filterSelect1" class="form-select" style="flex: 1; min-width: 150px;">
    <option value="">Filter 1</option>
  </select>
  <select id="filterSelect2" class="form-select" style="flex: 1; min-width: 150px;">
    <option value="">Filter 2</option>
  </select>
  <button onclick="applyFilters()" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
</div>
```

---

## 🔗 ROUTES TO ADD (Config/Routes.php)

```php
// Admin Web Routes
$routes->group('admin', ['filter' => 'auth'], static function($routes) {
    $routes->get('/', 'Admin\AdminController::dashboard');
    $routes->get('dashboard', 'Admin\AdminController::dashboard');

    // Dokter
    $routes->get('dokter', 'Admin\AdminController::dokter');

    // Spesialis
    $routes->get('spesialis', 'Admin\AdminController::spesialis');

    // Poli
    $routes->get('poli', 'Admin\AdminController::poli');

    // Jadwal
    $routes->get('jadwal', 'Admin\AdminController::jadwalRegular');
    $routes->get('jadwal/khusus', 'Admin\AdminController::jadwalKhusus');

    // Artikel
    $routes->get('artikel', 'Admin\AdminController::artikel');
    $routes->get('artikel/create', 'Admin\AdminController::artikelForm');
    $routes->get('artikel/edit/(:num)', 'Admin\AdminController::artikelForm/$1');

    // Gallery
    $routes->get('gallery', 'Admin\GalleryController::index');
});

// Existing API Routes (no change needed)
$routes->group('api/admin', ['filter' => 'auth'], static function($routes) {
    // All existing CRUD endpoints
});
```

---

## 🔍 SEARCH & FILTER IMPLEMENTATION

### Dokter Page

- **Search**: Nama dokter, profil
- **Filters**:
  - Spesialis (dropdown, single select)
  - Poli (dropdown, single select)
  - Hari (dropdown: Senin, Selasa, dst)

### Poli Page

- **Search**: Nama poli
- **Filters**:
  - Spesialis (dropdown, single select - dokter dari spesialis ini ada di poli mana saja)

### Jadwal Regular Page

- **Search**: Nama dokter
- **Filters**:
  - Dokter (dropdown)
  - Hari (dropdown)

### Artikel Page

- **Search**: Judul artikel, isi
- **Filters**: None (or tanggal publish range kalau mau)

### Spesialis Page

- **Search**: Nama spesialis
- **Filters**: None

---

## 🖼️ IMAGE GALLERY CONTROLLER & LOGIC

### GalleryController.php (NEW)

```php
<?php
namespace App\Controllers\Admin;

class GalleryController extends AdminController
{
    public function index()
    {
        return view('admin/gallery');
    }

    public function getImages()
    {
        $uploadsPath = FCPATH . 'uploads/';
        $images = [];

        foreach (['doctors', 'articles'] as $folder) {
            $path = $uploadsPath . $folder . '/';
            if (is_dir($path)) {
                $files = glob($path . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                foreach ($files as $file) {
                    $images[] = [
                        'name' => basename($file),
                        'path' => '/uploads/' . $folder . '/' . basename($file),
                        'folder' => $folder,
                        'size' => filesize($file),
                        'type' => mime_content_type($file)
                    ];
                }
            }
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => $images
        ]);
    }

    public function upload()
    {
        $file = $this->request->getFile('image');
        $folder = $this->request->getPost('folder') ?? 'doctors';

        if (!$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . "uploads/$folder/", $newName);

            return $this->response->setJSON([
                'status' => true,
                'data' => ['filename' => $newName]
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'errors' => ['Gagal upload file']
        ]);
    }

    public function delete()
    {
        $filename = $this->request->getPost('filename');
        $folder = $this->request->getPost('folder') ?? 'doctors';
        $filepath = FCPATH . "uploads/$folder/$filename";

        if (file_exists($filepath)) {
            unlink($filepath);
            return $this->response->setJSON(['status' => true]);
        }

        return $this->response->setJSON([
            'status' => false,
            'errors' => ['File tidak ditemukan']
        ]);
    }
}
?>
```

---

## 📊 DASHBOARD JADWAL SLIDER LOGIC

### JavaScript Pattern

```javascript
let currentDayIndex = 0;
const daysOfWeek = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

function loadJadwalForDay(dayName) {
  fetch(`${API_URL}/jadwal?hari=${dayName}`)
    .then((r) => r.json())
    .then((data) => {
      if (data.status && data.data.length > 0) {
        renderJadwalList(data.data);
      } else {
        document.getElementById("jadwalList").innerHTML = `
          <div class="empty-state">
            <i class="fas fa-calendar" style="font-size: 40px; color: #ccc;"></i>
            <p>Tidak ada jadwal di hari ${dayName}</p>
          </div>
        `;
      }
    });
}

function nextDay() {
  currentDayIndex = (currentDayIndex + 1) % 7;
  loadJadwalForDay(daysOfWeek[currentDayIndex]);
  updateDayDisplay();
}

function prevDay() {
  currentDayIndex = (currentDayIndex - 1 + 7) % 7;
  loadJadwalForDay(daysOfWeek[currentDayIndex]);
  updateDayDisplay();
}

function updateDayDisplay() {
  document.getElementById("currentDay").textContent = daysOfWeek[currentDayIndex];
}
```

---

## ⚠️ ERROR HANDLING & EDGE CASES

### Image Deleted from Filesystem

- Dokter/Artikel tampil dengan placeholder image
- Example:

```html
<img src="<?= $doctor['foto'] ? base_url('uploads/doctors/' . $doctor['foto']) : base_url('img/placeholder.png') ?>" onerror="this.src='<?= base_url('img/placeholder.png') ?>'" />
```

### Empty Data States

- Always show empty-state component dengan icon + message + CTA button
- Don't show table skeleton, langsung empty message

### Validation Errors

- Show all field errors in alert with red color
- Highlight invalid fields in form

---

## 🎯 TESTING CHECKLIST

- [ ] Desktop responsiveness (1024px+)
- [ ] Mobile responsiveness (<1024px, hamburger menu)
- [ ] Sidebar toggle on mobile
- [ ] Search functionality (real-time or on click)
- [ ] Filter dropdowns populate correctly
- [ ] Modal CRUD operations (create/edit/delete)
- [ ] Pagination for artikel
- [ ] Image upload/delete in gallery
- [ ] Empty states display correctly
- [ ] Hover effects on cards/buttons
- [ ] Alert messages show/disappear
- [ ] Calendar picker changes jadwal display
- [ ] Logout functionality

---

## 📝 NOTES FOR NEXT SESSION

1. **Token Efficiency**: Implementasikan phase per phase, commit/save setelah setiap phase
2. **Reusability**: Sidebar & new_layout akan dipakai semua halaman, prioritaskan ini
3. **CSS**: Pisahkan styling ke file terpisah atau keep in `<style>` tag
4. **Mobile First**: Test di mobile dulu, baru desktop
5. **API**: Semua endpoints sudah ada, cukup consume dari frontend
6. **Color Palette**: Copy-paste exact hex codes (#ff8a3d, #1a1a1a, dst)
7. **Jadwal Khusus**: Phase 5, jangan dimulai sampai Phase 4 selesai

---

## 🚀 QUICK START (Next Session)

1. Start dengan create `app/Views/admin/new_layout.php`
2. Update `app/Views/admin/sidebar.php`
3. Test layout on desktop & mobile
4. Lanjut ke dashboard redesign
5. Follow phase order

**Good luck! 💪**
