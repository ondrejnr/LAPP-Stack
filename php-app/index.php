<?php
echo "<h1>LAPP Stack via Glasskube</h1>";
 = "lapp-db-rw.lapp-production.svc.cluster.local";
   = "app";
 = "app";
// Password will be injected via secret in the final step
 = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    if ($pdo) { echo "Successfully connected to Postgres!"; }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
