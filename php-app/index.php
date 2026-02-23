<?php
echo "<h1>Social Rent Demo Platform</h1>";

$host = "lapp-db-rw.lapp-production.svc.cluster.local";
$db   = "app";
$user = "app";
$pass = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "<p style='color:green;'>✅ Connected to database</p>";
} catch (Exception $e) {
    die("<p style='color:red;'>❌ ".$e->getMessage()."</p>");
}

// CSV download
if (isset($_GET['csv'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=\"social_rent.csv\"');
    $search_region = $_GET['region'] ?? '';
    $search_year = $_GET['year'] ?? '';
    $args = [];
    $where = [];
    if ($search_region) {$where[]='region ILIKE ?'; $args[]='%'.$search_region.'%';}
    if ($search_year)   {$where[]='year = ?';        $args[]=$search_year;}
    $where_clause = $where ? "WHERE ".implode(" AND ",$where) : "";
    $stmt = $pdo->prepare("SELECT * FROM social_rent $where_clause ORDER BY year DESC, region ASC");
    $stmt->execute($args);
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID','Region','Year','Units','Avg Rent','Notes']);
    foreach ($stmt as $row) fputcsv($out, $row);
    fclose($out);
    exit;
}

// Main search logic
$search_region = $_GET['region'] ?? '';
$search_year = $_GET['year'] ?? '';
$args = [];
$where = [];
if ($search_region) {$where[]='region ILIKE ?'; $args[]='%'.$search_region.'%';}
if ($search_year)   {$where[]='year = ?';        $args[]=$search_year;}
$where_clause = $where ? "WHERE ".implode(" AND ",$where) : "";
$stmt = $pdo->prepare("SELECT * FROM social_rent $where_clause ORDER BY year DESC, region ASC");
$stmt->execute($args);

// Search + CSV button
?>
<form method="get">
    Region: <input name="region" value="<?=htmlspecialchars($search_region)?>">
    Year: <input name="year" value="<?=htmlspecialchars($search_year)?>">
    <input type="submit" value="Search">
    <button type="submit" name="csv" value="1">Download as CSV</button>
</form>
<a href="/">Show all</a>
<?php

// Result table
echo "<h2>Results</h2><table border=1 cellpadding=5>
<tr><th>ID</th><th>Region</th><th>Year</th><th>Units</th><th>Avg Rent</th><th>Notes</th></tr>";
foreach ($stmt as $row) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['region']}</td>
    <td>{$row['year']}</td>
    <td>{$row['units']}</td>
    <td>{$row['avg_rent']}</td>
    <td>{$row['notes']}</td>
    </tr>";
}
echo "</table>";
