# 🆘 TROUBLESHOOTING GUIDE - Klinik Brayan Sehat Admin Panel

## How to Use This Guide

1. Note the exact error message you see
2. Find it in the table below
3. Follow the recommended solution

---

## Common Issues & Solutions

### 1. **"Invalid JSON (401) or (403)"**

**What it means:** You're not logged in or session expired

**Solution:**

- Go to `http://localhost:8080/admin`
- Login with your admin credentials
- Try the operation again

**Check:**

- Open browser DevTools (F12)
- Go to Application → Cookies → ci_session
- Make sure ci_session cookie exists

---

### 2. **"Invalid JSON (500)"**

**What it means:** Server error - something went wrong processing the request

**Solution:**

- Check the error message shown
- It will tell you what validation failed
- Fix the input (e.g., missing required field)
- Try again

**Debug:**

- Open browser DevTools → Console
- You'll see detailed error logs
- Server logs are at: `/writable/logs/`

---

### 3. **"Gagal memuat data [tabel]: " + error**

**What it means:** Failed to load the data table (reads from database)

**Likely causes:**

- Database connection problem
- Model configuration issue
- Unknown column error

**Solution:**

1. Check database connection in `.env`
2. Run `php DATABASE_AUDIT.php` in terminal
3. Review the output for connection errors or schema issues

---

### 4. **"Terjadi kesalahan: XMLHttpRequest: cross origin request blocked"**

**What it means:** CORS (Cross-Origin) issue - browser blocking the request

**Solution:**

- Make sure you're accessing via `http://localhost:8080`
- Not `http://127.0.0.1:8080` or other variants
- Check that API_URL in your JavaScript is correct

**Check in browser console:**

- Look for CORS errors
- They mention blocked request to specific URL

---

### 5. **"Unknown column 'updated_at' in 'field list'"**

**What it means:** Model trying to save a column that doesn't exist

**Solution:**

- This should NOT happen anymore (already fixed)
- If you see it, run: `php DATABASE_AUDIT.php`
- It will show which model/table mismatch exists
- Check that the model's `useTimestamps` matches table columns

---

### 6. **Photo/File Not Saving or Disappearing**

**What it means:** Upload worked but file missing after page refresh

**Check these paths:**

- Doctor photos: `/public/uploads/doctors/`
- Article thumbnails: `/public/uploads/articles/`
- Gallery images: `/public/uploads/gallery/`

**Solution:**

1. Make sure `/public/uploads/` folders exist and are writable
2. Check folder permissions: `chmod -R 755 public/uploads/`
3. Check disk space is available
4. Check browser console for upload errors

---

### 7. **"Gagal memuat data" with NO detailed error message**

**What it means:** An old version of the page is cached

**Solution:**

- Hard refresh the page: `Ctrl+Shift+R` (Windows) or `Cmd+Shift+R` (Mac)
- Clear browser cache
- Make sure you have the latest code deployed

---

### 8. **Login page appears repeatedly / Won't stay logged in**

**What it means:** Session not persisting or CSRF token issue

**Solution:**

1. **Clear cookies:**
   - Open DevTools → Application → Cookies
   - Delete `ci_session`
   - Refresh page and login again

2. **Check CSRF token:**
   - Open DevTools → Network tab
   - When you login, look at the POST request
   - Should include `csrf_test_name` parameter with value

3. **Check session storage:**
   - Files should exist at: `/writable/session/`
   - Check folder is writable: `ls -la writable/session/`

---

### 9. **"Spesialis berhasil ditambahkan" but doesn't appear in list**

**What it means:** Data saved but not appearing in table

**Solution:**

1. Refresh the page (F5)
2. Hard refresh to clear cache (Ctrl+Shift+R)
3. Check database directly:
   ```sql
   SELECT * FROM tbl_spesialis ORDER BY created_at DESC LIMIT 5;
   ```
4. If it's in database but not showing:
   - Check browser console for JavaScript errors
   - Run hard refresh on that page

---

### 10. **Upload shows success but file size is 0 KB**

**What it means:** File uploaded but is empty or truncated

**Solution:**

- Check file wasn't corrupted before upload
- Check file size limit in `/app/Config/Upload.php`
- Check disk space available
- Try with a different, smaller file

---

## 🔍 How to Debug Issues

### **Step 1: Check Browser Console**

1. Press F12 to open DevTools
2. Go to "Console" tab
3. Look for red error messages
4. They now include specific error details

### **Step 2: Check Network Tab**

1. Press F12 to open DevTools
2. Go to "Network" tab
3. Try your operation again
4. Click the failed request
5. Look at "Response" tab to see what server returned

### **Step 3: Check Server Logs**

1. Open terminal
2. Go to project folder
3. Run: `tail -f writable/logs/log-YYYY-MM-DD.log`
4. Try the operation again
5. Watch the logs scroll to see server-side errors

### **Step 4: Run Diagnostic**

1. Open terminal in project folder
2. Run: `php DATABASE_AUDIT.php`
3. It will show all table structures and model configurations
4. Look for any mismatches

---

## 📋 Pre-Flight Checklist

Before reporting an issue, verify:

- [ ] I'm logged in (check /admin page shows content)
- [ ] I hard-refreshed the page (Ctrl+Shift+R)
- [ ] Database is running (can I access phpmyadmin?)
- [ ] Server is running (can I access other pages?)
- [ ] I'm using `http://localhost:8080`, not IP address
- [ ] Browser console shows JSON error, not HTML error
- [ ] I've followed the steps in this guide

---

## 🚨 Critical Issues - Emergency Procedures

### **Complete CRUD Failure - Nothing Works**

1. **Restart everything:**

   ```bash
   # Stop server
   ctrl+c (in terminal)

   # Clear cache
   php spark cache:clear

   # Restart server
   php spark serve
   ```

2. **Reset session:**

   ```bash
   rm -rf writable/session/*
   ```

3. **Check logs:**
   ```bash
   tail -f writable/logs/log-*.log
   ```

---

### **Database Connection Lost**

1. **Verify connection:**

   ```bash
   php spark db:create
   php spark db:table --table tbl_poli
   ```

2. **Check .env file:**
   - Make sure `database.default.hostname` is correct (localhost)
   - Make sure `database.default.database` is `klinik_brayan_sehat`
   - Make sure MySQL service is running

3. **Reset database:**
   ```bash
   # This will erase all data!
   php spark migrate:refresh
   ```

---

### **Photos Not Uploading**

1. **Check permissions:**

   ```bash
   ls -la public/uploads/
   chmod -R 777 public/uploads/
   ```

2. **Check uploads folder exists:**

   ```bash
   mkdir -p public/uploads/doctors
   mkdir -p public/uploads/articles
   mkdir -p public/uploads/gallery
   chmod -R 777 public/uploads/
   ```

3. **Check file size limit in php.ini:**
   - `upload_max_filesize = 128M`
   - `post_max_size = 128M`

---

## 📞 When to Get Help

Include these details when reporting:

1. **Exact error message** from browser console
2. **HTTP status code** (401, 403, 500, etc.)
3. **What you were trying to do** (create doctor, upload photo, etc.)
4. **What you expected to happen**
5. **Browser console screenshot** (F12 → Console tab)
6. **Server log entries** from recent attempt

---

## ✅ Testing Operations

### Test Everything Works

1. **Open CRUD Test Page:**
   - Go to `http://localhost:8080/crud-test.html`
   - This tool tests all operations

2. **Manual Quick Test:**
   - Login to admin panel
   - Click "Data Poli"
   - Click "Tambah Poli"
   - Enter: nama = "Test", deskripsi = "Test"
   - Click Simpan
   - Should see green "Poli berhasil ditambahkan" message

3. **If this works:**
   - All core systems are OK
   - Any specific issue is localized to that operation

---

## 📚 Reference Docs

- Database Schema: See `DATABASE_AUDIT.php` output
- Model Configuration: Check each model file for `useTimestamps`
- Error Pattern: Look at any `admin/*.php` file - all now use same error handling
- API Responses: See `IMPLEMENTATION_COMPLETE.md`

---

## 🎓 Understanding Error Messages

### Good Error (Helpful)

```
"loadDokter Error: Invalid JSON (500): <!DOCTYPE html>"
```

✅ Shows function name, status code, and response start
→ Means we got HTML when expecting JSON (server error)

### Bad Error (Not Helpful)

```
"Gagal memuat data"
```

❌ Tells you nothing about the actual problem
→ This has been fixed in current version

### Current Errors (Detailed)

```
Error message: Admin must logon first
```

✅ Clear message about what's wrong
→ You know exactly what to fix

---

## 🔄 Workflow for Fixing Unknown Issues

1. **Reproduce the issue**
   - Note exactly what steps cause it

2. **Check browser console (F12)**
   - Copy the exact error message

3. **Check network tab (F12)**
   - See what API response came back

4. **Check server logs**
   - `tail -f writable/logs/log-*.log`

5. **Look up error in this guide**
   - If similar, follow the solution

6. **Run diagnostic script**
   - `php DATABASE_AUDIT.php`
   - Look for configuration mismatches

7. **Hard refresh page**
   - Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)

8. **Clear cache if needed**
   - `php spark cache:clear`

9. **Restart server**
   - Stop with Ctrl+C
   - Run `php spark serve` again

---

**Last Updated:** Now  
**Version:** 1.0  
**Status:** Ready for production use
