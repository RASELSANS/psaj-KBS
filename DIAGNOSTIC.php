<?php
/**
 * COMPREHENSIVE DIAGNOSTIC REPORT
 * This script diagnoses the entire project setup
 */

echo "====================================\n";
echo "KLINIK BRAYAN SEHAT - DIAGNOSTIC REPORT\n";
echo "====================================\n\n";

// Bootstrap CI4
require_once __DIR__ . '/vendor/autoload.php';

// 1. DATABASE CHECK
echo "[1] DATABASE CONNECTION\n";
echo "---\n";
try {
    $config = new \Config\Database();
    $db = \Config\Database::connect();
    $test = $db->query("SELECT 1");
    echo "✓ Database connection OK\n";
    
    // Check admin user
    $admin = $db->query("SELECT COUNT(*) as count FROM tbl_admin WHERE username='admin'")->getRow();
    if ($admin) {
        echo "✓ Admin user exists: count=" . $admin->count . "\n";
        if ($admin->count == 0) {
            echo "  ⚠ WARNING: No admin user found!\n";
        }
    }
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
}

// 2. SESSION CONFIGURATION
echo "\n[2] SESSION CONFIGURATION\n";
echo "---\n";
$config = new \Config\Session();
echo "Cookie Name: " . $config->cookieName . "\n";
echo "Expiration: " . $config->expiration . " seconds\n";
echo "Save Path: " . $config->savePath . "\n";
echo "Match IP: " . ($config->matchIP ? 'YES' : 'NO') . "\n";
echo "Time to Update: " . $config->timeToUpdate . " seconds\n";

// Check if session path is writable
if (is_writable($config->savePath)) {
    echo "✓ Session path is writable\n";
} else {
    echo "✗ Session path is NOT writable: " . $config->savePath . "\n";
}

// 3. SECURITY CONFIGURATION
echo "\n[3] SECURITY CONFIGURATION\n";
echo "---\n";
$security = new \Config\Security();
echo "CSRF Protection: " . $security->csrfProtection . "\n";
echo "CSRF Token Name: " . $security->tokenName . "\n";
echo "CSRF Header Name: " . $security->headerName . "\n";
echo "CSRF Cookie Name: " . $security->cookieName . "\n";

// 4. ROUTES CHECK
echo "\n[4] ROUTES CONFIGURATION\n";
echo "---\n";
$routes_file = __DIR__ . '/app/Config/Routes.php';
if (file_exists($routes_file)) {
    echo "✓ Routes.php found\n";
    $content = file_get_contents($routes_file);
    
    // Check for key routes
    $checks = [
        'api/admin/login' => 'Login endpoint',
        "group.*api/admin.*filter.*auth" => 'API Admin protected group',
        "group.*admin.*filter.*auth" => 'Web Admin protected group',
    ];
    
    foreach ($checks as $pattern => $name) {
        if (preg_match("/$pattern/i", $content)) {
            echo "✓ $name configured\n";
        } else {
            echo "? $name - check configuration\n";
        }
    }
} else {
    echo "✗ Routes.php not found\n";
}

// 5. FILTER CHECK
echo "\n[5] AUTH FILTER\n";
echo "---\n";
$filter_file = __DIR__ . '/app/Filters/AuthFilter.php';
if (file_exists($filter_file)) {
    echo "✓ AuthFilter.php found\n";
    $content = file_get_contents($filter_file);
    if (strpos($content, "/api/") !== false) {
        echo "✓ Filter checks for /api/ path\n";
    } else if (strpos($content, "'api/'") !== false) {
        echo "⚠ Filter checks 'api/' WITHOUT leading slash - POTENTIAL BUG\n";
    }
} else {
    echo "✗ AuthFilter.php not found\n";
}

// 6. CONTROLLERS CHECK
echo "\n[6] CONTROLLERS\n";
echo "---\n";
$controllers = [
    'Admin/AuthController.php' => 'Login/Auth',
    'Admin/PoliController.php' => 'Poli Management',
    'Admin/DoctorController.php' => 'Doctor Management',
];

foreach ($controllers as $file => $name) {
    $path = __DIR__ . '/app/Controllers/' . $file;
    if (file_exists($path)) {
        echo "✓ $name controller found\n";
        
        // Check for try-catch in create methods
        if ($file === 'Admin/PoliController.php') {
            $content = file_get_contents($path);
            if (strpos($content, "try {") !== false) {
                echo "  ✓ Try-catch error handling present\n";
            } else {
                echo "  ⚠ No try-catch in create method\n";
            }
        }
    } else {
        echo "✗ $name controller NOT found\n";
    }
}

// 7. VIEWS CHECK
echo "\n[7] VIEWS\n";
echo "---\n";
$views = [
    'admin/poli.php' => 'Poli page',
    'admin/new_layout.php' => 'Admin layout',
];

foreach ($views as $file => $name) {
    $path = __DIR__ . '/app/Views/' . $file;
    if (file_exists($path)) {
        echo "✓ $name found\n";
        
        // Check for credentials in fetch
        $content = file_get_contents($path);
        if (strpos($content, "credentials: 'include'") !== false) {
            echo "  ✓ Has credentials in fetch calls\n";
        } else {
            echo "  ⚠ Missing credentials in fetch calls\n";
        }
    } else {
        echo "✗ $name NOT found\n";
    }
}

// 8. ENVIRONMENT CHECK
echo "\n[8] ENVIRONMENT\n";
echo "---\n";
echo "PHP Version: " . phpversion() . "\n";
echo "OS: " . php_uname() . "\n";
echo "Writable folders:\n";

$writable_dirs = [
    'writable/session' => 'Session storage',
    'writable/cache' => 'Cache storage',
    'writable/logs' => 'Log storage',
    'writable/uploads' => 'Upload storage',
];

foreach ($writable_dirs as $dir => $name) {
    $path = __DIR__ . '/' . $dir;
    if (is_writable($path)) {
        echo "  ✓ $name: $path\n";
    } else {
        echo "  ✗ $name: NOT writable - $path\n";
    }
}

// 9. FILE PERMISSIONS
echo "\n[9] CRITICAL FILES\n";
echo "---\n";
$files = [
    'app/Config/Database.php',
    'app/Config/Session.php',
    'app/Config/Security.php',
    'app/Config/Routes.php',
];

foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        echo "✓ $file ($perms)\n";
    } else {
        echo "✗ $file NOT found\n";
    }
}

// 10. MODELS CHECK
echo "\n[10] MODELS\n";
echo "---\n";
$models = ['Admin', 'Poli', 'Doctor', 'Spesialis'];
foreach ($models as $model) {
    $path = __DIR__ . '/app/Models/' . $model . '.php';
    if (file_exists($path)) {
        echo "✓ $model model found\n";
    } else {
        echo "✗ $model model NOT found\n";
    }
}

echo "\n====================================\n";
echo "DIAGNOSTIC COMPLETE\n";
echo "====================================\n";
