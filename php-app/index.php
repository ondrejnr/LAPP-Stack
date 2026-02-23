<?php
echo "<h1>LAPP Stack Status</h1>";
$host = "lapp-db-rw.lapp-production.svc.cluster.local";
$db   = "app";
$user = "app";
$pass = getenv('DB_PASSWORD');
try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ATTR_ERRMODE_EXCEPTION]);
    echo "<h2 style='color:green;'>✅ Connected to Postgres successfully!</h2>";
} catch (Exception $e) {
    echo "<h2 style='color:red;'>❌ Connection Failed</h2>";
    echo $e->getMessage();
}
?>
