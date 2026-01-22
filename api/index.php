<?php


// Vercel /tmp setup for SQLite
$dbPath = '/tmp/database.sqlite';
$source = __DIR__ . '/../database/database.sqlite';

if (!file_exists($dbPath) && file_exists($source)) {
    copy($source, $dbPath);
}

// Force SQLite connection for Vercel
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = $dbPath;
putenv("DB_CONNECTION=sqlite");
putenv("DB_DATABASE={$dbPath}");

require __DIR__ . '/../public/index.php';
