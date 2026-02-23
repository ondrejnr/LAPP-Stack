<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>LAPP Stack Status</h1>";

if (!extension_loaded('pdo_pgsql')) {
    echo "<p style='color:red;'>❌ pdo_pgsql driver NOT found.</p>";
} else {
    echo "<p style='color:green;'>✅ pdo_pgsql driver is loaded.</p>";
}

$host = "lapp-db-rw.lapp-production.svc.cluster.local";
$db   = "app";
$user = "app";
$pass = getenv('DB_PASSWORD');

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ATTR_ERRMODE_EXCEPTION]);
    echo "<h2 style='color:green;'>✅ Connected to Postgres successfully!</h2>";
} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ Connection Failed</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
