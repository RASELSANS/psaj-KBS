# Admin Views Documentation

## Overview

Complete admin CRUD interface for managing doctors, specialties, polyclinics, schedules, and articles. All views use Bootstrap 5.3.0 with consistent orange (#ff8a3d) design matching the main site.

---

## Admin Views List

### 1. **Dashboard** (`/admin/dashboard`)

- **Route**: `GET /admin/dashboard` or `GET /admin`
- **Purpose**: Admin home with statistics overview
- **Features**:
  - Admin profile display
  - Total count cards for each entity (Dokter, Spesialis, Poli, Jadwal, Artikel)
  - Quick navigation menu to all management pages
  - Real-time stats loaded from API

### 2. **Dokter (Doctors)** (`/admin/dokter`)

- **Route**: `GET /admin/dokter`
- **Purpose**: Manage doctors with photos and specialties
- **Features**:
  - Paginated table (10 per page)
  - Display: nama_doctor, spesialis list, poli list, foto thumbnail
  - Create: nama_doctor, profil, foto upload, select multiple spesialis & poli
  - Edit: Update all fields including photo replacement
  - Delete: Remove doctor and old photo
  - Modal form for create/update operations
  - File upload validation (max 2MB, JPG/PNG/GIF)
  - Saves to: `/public/uploads/doctors/`

**API Endpoints Used**:

- `GET /api/admin/doctors?page=X` - List doctors with pagination
- `GET /api/doctors/{id}` - Get doctor details with relations
- `POST /api/admin/doctors` - Create doctor
- `PUT /api/admin/doctors/{id}` - Update doctor
- `DELETE /api/admin/doctors/{id}` - Delete doctor

### 3. **Spesialis (Specialties)** (`/admin/spesialis`)

- **Route**: `GET /admin/spesialis`
- **Purpose**: Manage medical specialties
- **Features**:
  - All-in-one table (no pagination)
  - Display: nama_spesialis
  - CRUD operations in modal form
  - Simple checkbox selection

**API Endpoints Used**:

- `GET /api/admin/spesialis` - List all specialties
- `POST /api/admin/spesialis` - Create specialty
- `PUT /api/admin/spesialis/{id}` - Update specialty
- `DELETE /api/admin/spesialis/{id}` - Delete specialty

### 4. **Poli (Polyclinics)** (`/admin/poli`)

- **Route**: `GET /admin/poli`
- **Purpose**: Manage polyclinics/departments
- **Features**:
  - All-in-one table (no pagination)
  - Display: nama_poli, deskripsi
  - CRUD operations in modal form
  - Textarea for description

**API Endpoints Used**:

- `GET /api/admin/poli` - List all polyclinics
- `POST /api/admin/poli` - Create polyclinic
- `PUT /api/admin/poli/{id}` - Update polyclinic
- `DELETE /api/admin/poli/{id}` - Delete polyclinic

### 5. **Jadwal (Schedules)** (`/admin/jadwal`)

- **Route**: `GET /admin/jadwal`
- **Purpose**: Manage doctor schedules/workings
- **Features**:
  - Grouped display by doctor (flattened in table)
  - Display: dokter (name), hari, jam_mulai, jam_selesai
  - Create: Select doctor, enter hari (e.g., "Senin-Jumat"), time range
  - Edit: Change any schedule field
  - Delete: Remove schedule
  - Doctor dropdown populated from API
  - Time picker inputs for jam_mulai & jam_selesai

**API Endpoints Used**:

- `GET /api/doctors` - Get all doctors with their schedules
- `POST /api/admin/jadwal` - Create schedule
- `PUT /api/admin/jadwal/{id}` - Update schedule
- `DELETE /api/admin/jadwal/{id}` - Delete schedule

### 6. **Artikel (Articles)** (`/admin/artikel`)

- **Route**: `GET /admin/artikel`
- **Purpose**: Manage blog articles
- **Features**:
  - Paginated table (10 per page)
  - Display: judul, thumbnail preview, tanggal_publish (formatted)
  - Create: judul, isi (textarea), tanggal_publish (date picker), thumbnail upload
  - Edit: Update all fields including thumbnail replacement
  - Delete: Remove article and old thumbnail
  - Modal form for create/update operations
  - File upload validation (max 2MB, JPG/PNG/GIF)
  - Saves to: `/public/uploads/articles/`
  - Date formatting: Indonesian locale (dd-mm-yyyy)

**API Endpoints Used**:

- `GET /api/admin/artikel?page=X` - List articles with pagination
- `GET /api/artikel/{id}` - Get article detail
- `POST /api/admin/artikel` - Create article
- `PUT /api/admin/artikel/{id}` - Update article
- `DELETE /api/admin/artikel/{id}` - Delete article

---

## Common Features

### Navigation

All admin pages include a sticky navbar with:

- Admin brand/logo link (returns to dashboard)
- Navigation links to all CRUD pages
- Active page indicator
- Logout button (red #e74c3c)

### Layout

- Main container: max-width 1180px, centered
- Data cards: white background, 20px border-radius, subtle shadow
- Tables: responsive, striped, with hover effects
- Modals: Bootstrap 5 with 20px border-radius

### Styling

- Primary color: #ff8a3d (orange) - buttons, links
- Success color: #4CAF50 (green) - edit buttons
- Danger color: #e74c3c (red) - delete buttons
- Font: Poppins (Google Fonts)
- Shadows: rgba(255,138,61,0.15) for orange tint

### CRUD Operations

- **Create**: Button with icon + "Tambah [Entity]" → Modal form → POST
- **Read**: Tables with pagination (where applicable)
- **Update**: Edit button → Modal form prefilled → PUT
- **Delete**: Delete button → Confirm dialog → DELETE

### Alert System

- Success messages: Green alerts (top of page)
- Error messages: Red alerts with validation errors from API
- Auto-dismiss after 5 seconds or manual close

### Validation

- Form validation: Required fields enforced on form level
- File validation: 2MB, JPG/PNG/GIF extensions
- API validation errors: Displayed in red alerts with field error details

---

## Access Control

All admin routes are **protected by the `auth` filter**:

- Requires `$_SESSION['admin_id']` to be set
- Redirects to login if not authenticated
- Returns 401 for API requests if not authenticated

**Default Admin Credentials**:

- Username: `admin`
- Password: `admin123`

---

## File Structure

```
app/Views/admin/
├── layout.php           # Base template with navbar, styles, helpers
├── dashboard.php        # Dashboard with stats
├── dokter.php          # Doctor CRUD
├── spesialis.php       # Specialty CRUD
├── poli.php            # Polyclinic CRUD
├── jadwal.php          # Schedule CRUD
├── artikel.php         # Article CRUD
└── login.php           # Login form (pre-existing)

app/Controllers/Admin/
├── AdminController.php       # Base + view methods
├── AuthController.php        # Login/Logout
├── DoctorController.php      # Doctor API CRUD
├── SpesialisController.php   # Specialty API CRUD
├── PoliController.php        # Polyclinic API CRUD
├── JadwalController.php      # Schedule API CRUD
└── ArtikelController.php     # Article API CRUD
```

---

## JavaScript Functions

Available in `layout.php`:

```javascript
// Show alert message
showAlert(message, type); // type: 'success', 'danger', 'info', 'warning'

// Confirm delete action
confirmDelete(id, type); // type name for display

// Logout admin
logoutAdmin(); // POST to /api/admin/logout then redirect

// API Base URL
API_URL = "http://localhost:8080/api/admin";
```

---

## Testing Checklist

- [ ] Access `/admin/dashboard` - shows dashboard with stats
- [ ] Access `/admin/dokter` - shows doctor list and can create/edit/delete
- [ ] Add doctor with multiple spesialis and poli
- [ ] Upload doctor photo - verify in `/public/uploads/doctors/`
- [ ] Edit doctor - verify data prefills in modal
- [ ] Delete doctor - verify confirms and removes
- [ ] Access `/admin/spesialis` - CRUD operations work
- [ ] Access `/admin/poli` - CRUD with deskripsi field works
- [ ] Access `/admin/jadwal` - schedule display and CRUD work
- [ ] Create schedule - verify doctor dropdown populated
- [ ] Access `/admin/artikel` - pagination and file upload work
- [ ] Upload article thumbnail - verify in `/public/uploads/articles/`
- [ ] Test logout - redirects to login
- [ ] Test accessing `/admin/*` without login - redirects to login

---

## Notes

1. **Image Uploads**: Ensure `/public/uploads/doctors/` and `/public/uploads/articles/` directories have write permissions.

2. **File Deletion**: When updating with new file, old file is automatically deleted.

3. **Pagination**:
   - Doctors: 10 per page
   - Articles: 10 per page
   - Others: All items in one table

4. **Date Format**:
   - Artikel display uses Indonesian locale (dd-mm-yyyy)
   - Input uses HTML date picker format

5. **Multiple Selection**:
   - Doctor - Spesialis: Checkboxes with scroll container
   - Doctor - Poli: Checkboxes with scroll container
   - Can select multiple values with [], sent as FormData array

6. **Database Relations**:
   - Doctor ↔ Spesialis (many-to-many via DoctorSpesialis)
   - Doctor ↔ Poli (many-to-many via DoctorPoli)
   - Doctor ← Jadwal (one-to-many)
   - Admin ← Artikel (one-to-many)

---

## URLs Reference

| Page        | URL                | Method |
| ----------- | ------------------ | ------ |
| Dashboard   | `/admin`           | GET    |
| Dashboard   | `/admin/dashboard` | GET    |
| Doctors     | `/admin/dokter`    | GET    |
| Specialties | `/admin/spesialis` | GET    |
| Polyclinics | `/admin/poli`      | GET    |
| Schedules   | `/admin/jadwal`    | GET    |
| Articles    | `/admin/artikel`   | GET    |

All views are protected by auth filter and require valid admin session.
