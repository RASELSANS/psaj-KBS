<?php
/**
 * SIMPLE DIAGNOSTIC - No CI4 bootstrap needed
 */

echo "\n====================================\n";
echo "SIMPLE PROJECT DIAGNOSTIC\n";
echo "====================================\n\n";

$projectRoot = __DIR__;

// 1. FILES EXIST CHECK
echo "[1] CRITICAL FILES EXIST\n";
echo "---\n";
$files = [
    'app/Config/Database.php' => 'Database config',
    'app/Config/Session.php' => 'Session config',
    'app/Config/Security.php' => 'Security config',
    'app/Config/Routes.php' => 'Routes config',
    'app/Filters/AuthFilter.php' => 'Auth filter',
    'app/Controllers/Admin/AuthController.php' => 'Auth controller',
    'app/Controllers/Admin/PoliController.php' => 'Poli controller',
    'app/Views/admin/poli.php' => 'Poli view',
    'app/Views/admin/new_layout.php' => 'Layout view',
    'writable/session/' => 'Session folder',
];

foreach ($files as $path => $name) {
    $fullPath = $projectRoot . '/' . $path;
    if (file_exists($fullPath)) {
        if (is_dir($fullPath)) {
            if (is_writable($fullPath)) {
                echo "✓ $name (writable)\n";
            } else {
                echo "⚠ $name (EXISTS but NOT writable)\n";
            }
        } else {
            echo "✓ $name\n";
        }
    } else {
        echo "✗ $name NOT FOUND\n";
    }
}

// 2. SESSION CONFIG ANALYSIS
echo "\n[2] SESSION CONFIGURATION\n";
echo "---\n";
$sessionFile = $projectRoot . '/app/Config/Session.php';
if (file_exists($sessionFile)) {
    $content = file_get_contents($sessionFile);
    
    // Extract config values
    preg_match('/public string \$cookieName = [\'"]([^\'"]+)[\'"]/', $content, $cookieMatch);
    preg_match('/public int \$expiration = ([0-9]+)/', $content, $expirationMatch);
    preg_match('/public string \$savePath = (.*);/', $content, $savePathMatch);
    
    echo "Cookie Name: " . ($cookieMatch[1] ?? 'UNKNOWN') . "\n";
    echo "Expiration: " . ($expirationMatch[1] ?? 'UNKNOWN') . " seconds\n";
    echo "Save Path: " . (isset($savePathMatch[1]) ? trim($savePathMatch[1]) : 'UNKNOWN') . "\n";
    
    if (strpos($content, 'matchIP') !== false) {
        preg_match('/public bool \$matchIP = ([a-z]+)/', $content, $matchMatch);
        echo "Match IP: " . ($matchMatch[1] ?? 'NOT CONFIGURED') . "\n";
    }
}

// 3. SECURITY CONFIG ANALYSIS
echo "\n[3] SECURITY/CSRF CONFIGURATION\n";
echo "---\n";
$securityFile = $projectRoot . '/app/Config/Security.php';
if (file_exists($securityFile)) {
    $content = file_get_contents($securityFile);
    
    preg_match('/public bool \$csrfProtection = ([a-z]+)/', $content, $protectMatch);
    preg_match('/public string \$tokenName = [\'"]([^\'"]+)[\'"]/', $content, $tokenMatch);
    preg_match('/public bool \$cookieSameSite = [\'"]?([^\';"\n]+)[\'"]?/', $content, $samesiteMatch);
    
    echo "CSRF Protection: " . ($protectMatch[1] ?? 'UNKNOWN') . "\n";
    echo "Token Name: " . ($tokenMatch[1] ?? 'UNKNOWN') . "\n";
    
    if (preg_match('/public string \$cookieSameSite = [\'"]([^\'"]+)[\'"]/', $content, $ssMatch)) {
        echo "Cookie SameSite: " . $ssMatch[1] . "\n";
    } else {
        echo "Cookie SameSite: NOT CONFIGURED (default=Lax)\n";
    }
}

// 4. ROUTES ANALYSIS
echo "\n[4] ROUTES CONFIGURATION\n";
echo "---\n";
$routesFile = $projectRoot . '/app/Config/Routes.php';
if (file_exists($routesFile)) {
    $content = file_get_contents($routesFile);
    
    $checks = [
        "post.*'api/admin/login'" => '✓ POST /api/admin/login (unprotected)',
        "get.*'api/admin/profile'" => '✓ GET /api/admin/profile',
        "group.*'api/admin'.*filter.*'auth'" => '✓ /api/admin/* (protected)',
        "group.*'admin'.*filter.*'auth'" => '✓ /admin/* (protected)',
    ];
    
    foreach ($checks as $pattern => $message) {
        if (preg_match("/$pattern/i", $content)) {
            echo "$message\n";
        }
    }
}

// 5. AUTH FILTER ANALYSIS
echo "\n[5] AUTH FILTER ANALYSIS\n";
echo "---\n";
$filterFile = $projectRoot . '/app/Filters/AuthFilter.php';
if (file_exists($filterFile)) {
    $content = file_get_contents($filterFile);
    
    if (preg_match("/strpos.*getPath.*'\/api\/'/", $content)) {
        echo "✓ Filter correctly checks for '/api/' (with leading slash)\n";
    } else if (preg_match("/strpos.*getPath.*'api\/'/", $content)) {
        echo "✗ BUG FOUND: Filter checks 'api/' (NO leading slash) - WILL FAIL\n";
    } else {
        echo "? Cannot determine path check pattern\n";
    }
}

// 6. POLI CONTROLLER ANALYSIS
echo "\n[6] POLI CONTROLLER ANALYSIS\n";
echo "---\n";
$poliControllerFile = $projectRoot . '/app/Controllers/Admin/PoliController.php';
if (file_exists($poliControllerFile)) {
    $content = file_get_contents($poliControllerFile);
    
    $checks = [
        'public function create' => 'Create method',
        'public function update' => 'Update method',
        'public function delete' => 'Delete method',
        'try {' => 'Try-catch error handling',
        'errorResponse' => 'Error response method',
    ];
    
    foreach ($checks as $pattern => $name) {
        if (strpos($content, $pattern) !== false) {
            echo "✓ $name found\n";
        } else {
            echo "✗ $name NOT found\n";
        }
    }
}

// 7. VIEWS ANALYSIS
echo "\n[7] VIEWS ANALYSIS\n";
echo "---\n";
$views = [
    'admin/poli.php' => 'poli',
    'admin/new_layout.php' => 'layout',
];

foreach ($views as $filePath => $name) {
    $fullPath = $projectRoot . '/app/Views/' . $filePath;
    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);
        
        echo "File: $name\n";
        
        // Check for credentials
        $credCount = substr_count($content, "credentials: 'include'");
        if ($credCount > 0) {
            echo "  ✓ Has credentials in $credCount fetch calls\n";
        } else {
            echo "  ⚠ NO credentials in fetch calls - SESSION COOKIE WON'T BE SENT\n";
        }
        
        // Check for Content-Type
        if (strpos($content, "Content-Type") !== false) {
            echo "  ✓ Has Content-Type headers\n";
        }
        
        // Check for URLSearchParams vs FormData
        $formData = substr_count($content, "new FormData()");
        $urlSearch = substr_count($content, "URLSearchParams");
        if ($urlSearch > 0) {
            echo "  ✓ Uses URLSearchParams for non-file forms ($urlSearch instances)\n";
        }
        if ($formData > 0) {
            echo "  ✓ Uses FormData for file uploads ($formData instances)\n";
        }
    }
}

// 8. DATABASE TABLES
echo "\n[8] DATABASE TABLES CHECK\n";
echo "---\n";
$dbConfigFile = $projectRoot . '/app/Config/Database.php';
if (file_exists($dbConfigFile)) {
    $content = file_get_contents($dbConfigFile);
    preg_match("/['\"](.*?)['\"].*=>.*\[\s*'hostname' => ['\"](.*?)['\"]/s", $content, $dbMatches);
    preg_match("/'DBDriver'.*=>.*['\"](.*?)['\"]", $content, $driverMatch);
    
    if (preg_match("/('database'|'database_.*'\s*=>.*['\"](.*?)['\"]/i", $content, $nameMatch)) {
        echo "Database Name: " . (str_replace("'", "", $nameMatch[2]) ?? 'UNKNOWN') . "\n";
    }
    echo "Driver: " . ($driverMatch[1] ?? 'UNKNOWN') . "\n";
}

// 9. PERMISSION SUMMARY
echo "\n[9] WRITABLE DIRECTORIES SUMMARY\n";
echo "---\n";
$writableDirs = [
    'writable/session',
    'writable/cache',
    'writable/logs',
    'writable/uploads',
];

foreach ($writableDirs as $dir) {
    $path = $projectRoot . '/' . $dir;
    if (is_writable($path)) {
        echo "✓ $dir\n";
    } else {
        echo "✗ $dir - NOT WRITABLE\n";
    }
}

echo "\n====================================\n";
echo "DIAGNOSTIC COMPLETE\n";
echo "====================================\n\n";
