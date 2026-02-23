<?php
// We use the internal K8s DNS name for your existing Postgres service
$host = "postgres-db.kafka-web.svc.cluster.local";
$db   = "postgres"; 
$user = "postgres";
$pass = "password123"; 

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "<h1>LAPP Stack Status: SUCCESS</h1>";
    echo "<p>Connected to PostgreSQL at $host</p>";
} catch (PDOException $e) {
    echo "<h1>LAPP Stack Status: CONNECTION FAILED</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
