<?php
require_once 'includes/db.php';

try {
    echo "<h1>Railway Database Automated Setup</h1>";

    // 1. Read Schema
    $schema = file_get_contents('schema.sql');

    // Remove 'CREATE DATABASE' and 'USE' lines because Railway provides a predefined database
    $schema = preg_replace('/CREATE DATABASE[^;]+;/i', '', $schema);
    $schema = preg_replace('/USE [^;]+;/i', '', $schema);

    // Execute Schema
    $pdo->exec($schema);
    echo "<p>✅ Tables created successfully.</p>";

    // 2. Read Seed
    $seed = file_get_contents('manual_seed.sql');

    // Execute Seed
    $pdo->exec($seed);
    echo "<p>✅ Initial content (Turkish/English) seeded successfully.</p>";

    echo "<h2 style='color: green;'>🎉 ALL DONE! Your website is ready.</h2>";
    echo "<p><strong>Security Warning:</strong> For your site's safety, please delete this <code>setup_db.php</code> file from your computer and GitHub after you confirm the site works.</p>";
    echo "<br><a href='index.php'>Go to Homepage</a>";

} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Database Sync Error:</h3>";
    echo "<pre>" . print_r($e->getMessage(), true) . "</pre>";
}
?>