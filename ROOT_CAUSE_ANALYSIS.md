# ROOT CAUSE ANALYSIS - Session Lost Error

## PROBLEM SUMMARY
You're getting "HTML login page" response instead of JSON when trying to save poli. This means:
- Session authenticated successfully ✓
- But when making API call, session is lost ✗
- Auth filter returns 401 redirect to login HTML ✗

## LIKELY ROOT CAUSES (Ranked by Probability)

### 🔴 **PRIMARY SUSPECT: Missing Cookie in Request** (90% probability)
Even though we added `credentials: 'include'` to fetch, there could be:
- **Timing issue**: Session cookie not fully set before first API call
- **Domain mismatch**: If API calls go to different domain/port
- **Lax vs None**: `SameSite=Lax` can block cookies in certain scenarios

**How to test**: Check Network tab → save request → Headers → Look for `Cookie:` header

### 🔴 **SECONDARY SUSPECT: Session Not Persisting to Disk** (60% probability)
Session file might not be saved properly:
- Session handler fails silently
- Folder permissions issue (fixed ✓)
- Session value not properly set in AuthController

**How to test**: 
```bash
# After login, check session file was created
ls -lrt writable/session/ | tail -5
```

### 🟡 **TERTIARY SUSPECT: CSRF Token Validation** (30% probability)
CSRF token might be rejecting requests:
- Token name mismatch (csrf_test_name vs csrf_token)
- Token value not matching between form and cookie

**Configuration checked**: ✓ All correct

### 🟡 **QUATERNARY SUSPECT: AuthFilter Logic** (10% probability - FIXED)
Path check was broken: `'api/'` vs `'/api/'`
- **Status**: FIXED ✓ Changed to include leading slash

---

## WHAT WE'VE ALREADY CHECKED ✓

- ✅ Files exist and writable
- ✅ Database connected
- ✅ Admin user exists
- ✅ Session folder is writable
- ✅ Auth filter now checks '/api/' correctly
- ✅ Try-catch error handling added to controllers
- ✅ `credentials: 'include'` added to all fetch calls
- ✅ URLSearchParams for non-file forms
- ✅ Session cookie name: `ci_session` ✓
- ✅ CSRF token name: `csrf_test_name` ✓

---

## WHAT STILL NEEDS VERIFICATION

1. **Is `ci_session` cookie being SET after login?**
   - Network tab → login request → Response Headers
   - Look for: `Set-Cookie: ci_session=...`

2. **Is `ci_session` cookie being SENT with API requests?**
   - Network tab → save request → Request Headers
   - Look for: `Cookie: ci_session=...`

3. **What does the API response actually contain?**
   - Is it JSON or HTML?
   - If HTML: session is lost, check timing

4. **Are session files being created?**
   ```bash
   ls -la writable/session/ | wc -l  # Count files
   ```

---

## QUICK FIXES TO TRY

### Fix #1: Restart PHP Server
```bash
# Kill any running PHP server
pkill -f "php spark serve"

# Wait 2 seconds
sleep 2

# Start fresh
php spark serve
```

### Fix #2: Clear Session Files
```bash
rm -f writable/session/*
```

### Fix #3: Check if Session Cookie is Secure
Session config might reject cookies due to HTTPS/HTTP mismatch.
- Current SameSite: `Lax` (just added)
- For localhost: Should be fine

### Fix #4: Verify Login Response
```bash
curl -X POST http://localhost:8080/api/admin/login \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "username=admin&password=admin&csrf_test_name=test" \
  -v  # Shows all headers including Set-Cookie
```

---

## MY BEST GUESS

The session cookie **IS being created** on login (otherwise login page would fail), but:

1. When you navigate to `/admin/poli` (web page), the session is valid ✓
2. You see the page load fine
3. But when you call `/api/admin/poli` (fetch API), cookie isn't sent

**Why this happens?**
- `credentials: 'include'` catches cookies for same-origin
- But if there's a 401 before the real request, it creates new session
- Session gets confused between web and API calls

**Solution to test:**
1. Log in
2. **Immediately** try to save poli (don't wait)
3. Check Network tab for cookie header

If cookie IS missing → that's definitely the bug!

---

## NEXT STEPS

1. **Do the browser debug steps** (see above)
2. Report what you see in Network tab
3. Let me know if:
   - ✅ or ❌ `Set-Cookie` in login response
   - ✅ or ❌ `Cookie:` in save request
   - Is response JSON or HTML?

**Then I can make targeted fix!**

