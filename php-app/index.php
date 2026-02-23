<?php
echo "<h1>LAPP Stack via Glasskube</h1>";

$host = "lapp-db-rw.lapp-production.svc.cluster.local";
$db   = "app";
$user = "app";
$pass = getenv('DB_PASSWORD');

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2 style='color:green;'>✅ Connected to Postgres successfully!</h2>";
    
    $query = $pdo->query('SELECT version()');
    $row = $query->fetch();
    echo "<p><b>Database:</b> " . $row[0] . "</p>";

} catch (Exception $e) {
    echo "<h2 style='color:red;'>❌ Connection Failed</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
