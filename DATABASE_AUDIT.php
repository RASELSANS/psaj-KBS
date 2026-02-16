<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'klinik_brayan_sehat';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "====================================\n";
    echo "DATABASE SCHEMA AUDIT\n";
    echo "====================================\n\n";

    // Get all tables
    $result = $conn->query("SHOW TABLES");
    $tables = [];
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    foreach ($tables as $table) {
        echo "📋 TABLE: $table\n";
        echo str_repeat('-', 80) . "\n";

        // Get columns for each table
        $columns = $conn->query("DESCRIBE $table");
        
        while ($col = $columns->fetch_assoc()) {
            $field = $col['Field'];
            $type = $col['Type'];
            $null = $col['Null'];
            $key = $col['Key'];
            $default = $col['Default'];
            
            $keyInfo = $key ? "[$key]" : "";
            $nullInfo = $null === 'YES' ? "NULL" : "NOT NULL";
            $defaultInfo = $default ? "DEFAULT $default" : "";
            
            printf("  %-20s %-20s %-10s %-8s %s\n", 
                $field, $type, $nullInfo, $keyInfo, $defaultInfo);
        }
        
        echo "\n";
    }

    echo "====================================\n";
    echo "MODELS CONFIGURATION CHECK\n";
    echo "====================================\n\n";

    $models = [
        'Poli' => ['table' => 'tbl_poli', 'primary' => 'id_poli'],
        'Doctor' => ['table' => 'tbl_dokter', 'primary' => 'id_doctor'],
        'Spesialis' => ['table' => 'tbl_spesialis', 'primary' => 'id_spesialis'],
        'Jadwal' => ['table' => 'tbl_jadwal', 'primary' => 'id_jadwal'],
        'Artikel' => ['table' => 'tbl_artikel', 'primary' => 'id_artikel'],
        'Admin' => ['table' => 'tbl_admin', 'primary' => 'id_admin'],
    ];

    require_once 'vendor/autoload.php';
    
    foreach ($models as $modelName => $info) {
        $modelClass = "App\\Models\\$modelName";
        $modelFile = "app/Models/$modelName.php";
        
        if (file_exists($modelFile)) {
            echo "📦 Model: $modelName\n";
            echo "   Table: {$info['table']}\n";
            echo "   Primary: {$info['primary']}\n";
            
            // Read model file to check configuration
            $content = file_get_contents($modelFile);
            
            // Check useTimestamps
            if (preg_match('/protected bool \$useTimestamps\s*=\s*(true|false)/', $content, $m)) {
                echo "   useTimestamps: " . $m[1] . "\n";
            }
            
            // Check allowedFields
            if (preg_match('/protected \$allowedFields\s*=\s*\[(.*?)\]/', $content, $m)) {
                echo "   allowedFields: [" . trim($m[1]) . "]\n";
            }
            
            echo "\n";
        }
    }

    $conn->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
