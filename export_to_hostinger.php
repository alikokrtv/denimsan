<?php
/**
 * export_to_hostinger.php
 * Exports Railway DB data as SQL INSERT statements for import into Hostinger.
 * Run once locally, then import the generated SQL via Hostinger phpMyAdmin.
 * DELETE this file after use!
 */

$pdo = new PDO(
    "mysql:host=switchback.proxy.rlwy.net;port=19532;dbname=railway;charset=utf8mb4",
    'root',
    'pzBAdbjkpXBzBCKULpPnuzVcNKRijtwu',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);

$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

$sql = "-- Denimsan DB Export from Railway → Hostinger\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
$sql .= "SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS=0;\n\n";

foreach ($tables as $table) {
    // Drop + Create
    $create = $pdo->query("SHOW CREATE TABLE `$table`")->fetch();
    $sql .= "-- Table: $table\n";
    $sql .= "DROP TABLE IF EXISTS `$table`;\n";
    $sql .= $create['Create Table'] . ";\n\n";

    // Data
    $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll();
    if (!empty($rows)) {
        $cols = '`' . implode('`, `', array_keys($rows[0])) . '`';
        $sql .= "INSERT INTO `$table` ($cols) VALUES\n";
        $inserts = [];
        foreach ($rows as $row) {
            $vals = array_map(function ($v) use ($pdo) {
                if ($v === null)
                    return 'NULL';
                return $pdo->quote($v);
            }, array_values($row));
            $inserts[] = '(' . implode(', ', $vals) . ')';
        }
        $sql .= implode(",\n", $inserts) . ";\n\n";
    }
}

$sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

$filename = 'denimsan_hostinger_import.sql';
file_put_contents($filename, $sql);
echo "Export complete! File: $filename (" . round(strlen($sql) / 1024, 1) . " KB)\n";
echo "Tables exported: " . implode(', ', $tables) . "\n";
?>