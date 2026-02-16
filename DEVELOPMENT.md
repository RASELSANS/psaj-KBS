# Development Setup Guide - Klinik Brayan Sehat Admin Panel

## Fixed Issues (February 15, 2026)

### ✅ 1. 500 Internal Server Error on GET /admin

**Root Cause:** `echo $this->session;` in AdminController was printing session object

**Fix:** Removed the invalid echo statement from `isLoggedIn()` method

**Impact:** Admin panel now loads correctly

---

### ✅ 2. Admin Page Could Be Accessed Without Login

**Root Cause:** Route logic was incorrect allowing bypass of authentication

**Fix:**

- Separated /admin route (no auth filter - shows login or redirects if logged in)
- Protected /admin/\* routes with auth filter
- Removed duplicate isLoggedIn route from group

**Impact:** Admin panel now properly protected

---

### ✅ 3. False Positive Warnings (FormData not imported, etc)

**Root Cause:** PHP Namespace Resolver extension flagged JavaScript APIs as missing PHP classes

**Files Created:**

- `.php-meta.php` - IDE meta file defining JS APIs for PHP context
- `.vscode/settings.json` - VSCode settings disabling false positive warnings
- `.vscode/extensions.json` - Recommended extensions config
- `phpstan.neon` - PHPStan static analysis config
- `.php-cs-fixer.dist.php` - Code style configuration
- `.editorconfig` - Editor configuration for consistency

**Impact:** All false positive warnings now suppressed, clean development experience

---

## Setup Instructions

### 1. PHP Version

```bash
php --version  # Should be 8.1+
```

### 2. Install Dependencies

```bash
cd "c:\laragon\www\Klinik Brayan Sehat\psaj-KBS"
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php spark key:generate
```

### 4. Database

```bash
# Create database
mysql -u root -e "CREATE DATABASE klinik_brayan_sehat CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"

# Run migrations
php spark migrate
```

### 5. Start Server

```bash
php spark serve
```

Then open:

- **Frontend:** http://localhost:8080
- **Admin (Login):** http://localhost:8080/admin
- **Admin (Dashboard):** http://localhost:8080/admin/dashboard (if logged in)

---

## Login Credentials (Default)

```
Username: admin
Password: admin123
```

---

## Route Structure

### Public Routes

```
GET /                          → Frontend homepage
GET /layanan                   → Services page
GET /doctors                   → Doctors list
GET /doctors/detail/:any       → Doctor detail
GET /artikel                   → Articles
GET /faq                       → FAQ
GET /kontak                    → Contact
```

### Admin Routes (No Auth)

```
GET /admin                     → Shows login OR redirects to dashboard if logged in
POST /api/admin/login          → API login endpoint
```

### Admin Routes (Auth Protected)

```
GET /admin/dashboard           → Dashboard
GET /admin/dokter              → Doctors management
GET /admin/spesialis           → Specialists management
GET /admin/poli                → Departments management
GET /admin/jadwal              → Schedules management
GET /admin/artikel             → Articles management
GET /admin/artikel_form        → Article create/edit page
GET /admin/gallery             → Image gallery management

POST /api/admin/logout         → Logout
GET /api/admin/profile         → Get admin profile
GET /api/admin/doctors         → List doctors
POST /api/admin/doctors        → Create doctor
PUT /api/admin/doctors/:id     → Update doctor
DELETE /api/admin/doctors/:id  → Delete doctor

# Similar routes for spesialis, poli, jadwal, artikel, gallery
```

---

## IDE Configuration

### VSCode Settings

All settings are configured in `.vscode/settings.json`:

- PHP validation enabled
- Intelephense language server with proper stubs
- Prettier formatter integration
- False positive warnings disabled
- View files excluded from analysis

### Recommended Extensions

```json
- esbenp.prettier-vscode          (Code formatter)
- bmewburn.vscode-intelephense-client (PHP Language Server)
- felixbecker.php-debug           (PHP Debugger)
- onecentlin.laravel5-snippets    (Laravel snippets)
```

### To Install Extensions

```bash
code --install-extension esbenp.prettier-vscode
code --install-extension bmewburn.vscode-intelephense-client
code --install-extension felixbecker.php-debug
```

---

## Code Quality Tools

### 1. PHP-CS-Fixer (Code Style)

```bash
# Fix code style issues
./vendor/bin/php-cs-fixer fix app --config=.php-cs-fixer.dist.php

# Check without fixing
./vendor/bin/php-cs-fixer fix app --config=.php-cs-fixer.dist.php --dry-run
```

### 2. PHPStan (Static Analysis)

```bash
# Install first time only
composer require --dev phpstan/phpstan

# Run analysis
./vendor/bin/phpstan analyse
```

### 3. PHPUnit (Tests)

```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test file
./vendor/bin/phpunit tests/unit/HealthTest.php
```

---

## Common Issues & Solutions

### Issue: 500 Error on /admin

**Solution:** Already fixed - ensure AdminController has no `echo $this->session;`

### Issue: "Class FormData not imported" warnings

**Solution:** Already fixed - check `.vscode/settings.json` is loaded and Intelephense extension is installed

### Issue: Can access admin pages without login

**Solution:** Already fixed - auth filter is properly applied to /admin/\* routes

### Issue: Modal confirmations show as system alert

**Solution:** Already fixed - custom modal dialogs are implemented in new_layout.php

### Issue: "Simpan" button looks bad

**Solution:** Already fixed - btn-modal-save styling added to new_layout.php

---

## API Base URL

All API endpoints use this base:

- **Local:** `http://localhost:8080/api/admin`
- **Production:** Update in `.env` and views

Example API call:

```javascript
const API_URL = "http://localhost:8080/api/admin";

fetch(`${API_URL}/doctors`)
  .then((response) => response.json())
  .then((data) => console.log(data));
```

---

## File Structure

```
app/
├── Config/                    # Configuration files
│   ├── App.php
│   ├── Database.php
│   ├── Routes.php            # All routes defined here
│   └── ...
├── Controllers/
│   ├── Admin/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── DoctorController.php
│   │   └── ...
│   └── ...
├── Models/                    # Database models
├── Views/
│   ├── admin/
│   │   ├── new_layout.php    # Main admin layout (modal definitions here)
│   │   ├── dashboard.php
│   │   ├── dokter.php
│   │   ├── poli.php
│   │   └── ...
│   └── ...
└── ...

.vscode/
├── settings.json             # IDE settings
├── extensions.json           # Recommended extensions
└── launch.json              # Debug configuration

.php-meta.php                 # IDE meta file for JS APIs
.php-cs-fixer.dist.php        # Code style config
.editorconfig                 # Editor config
phpstan.neon                  # Static analysis config
```

---

## Design System

### Colors

- **Primary (Orange):** #ff8a3d
- **Text (Dark):** #1a1a1a
- **Secondary (Gray):** #666, #999
- **Danger (Red):** #e74c3c
- **Success (Green):** #4CAF50
- **Background (Light):** #f8f9fa, #e9ecef

### Fonts

- **Family:** Poppins (Google Fonts)
- **Sizes:** 0.9rem - 1.3rem

### Components

- **Modals:** new_layout.php defines both data modals and confirm modals
- **Buttons:** .btn-add, .btn-action, .btn-edit, .btn-delete, .btn-modal-save
- **Form Controls:** .form-control, .form-select with 12px border-radius
- **Tables:** .table with .btn-action buttons

---

## Next Steps (Phase 6+)

- [ ] Phase 6: Routes & Controller Finalization
- [ ] Phase 7: Jadwal Khusus (Special Schedules)
- [ ] Phase 8: User Management
- [ ] Phase 9: Audit Logs
- [ ] Phase 10: API Documentation (Swagger/OpenAPI)

---

## Support

For issues related to:

- **Routes:** Check `app/Config/Routes.php`
- **API Errors:** Check `app/Controllers/Admin/*Controller.php`
- **UI/UX:** Check `app/Views/admin/*.php` and `new_layout.php`
- **Database:** Check `app/Models/*.php` and migrations

---

**Last Updated:** February 15, 2026  
**Status:** ✅ Phase 5 Complete - Production Ready
