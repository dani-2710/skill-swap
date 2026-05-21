<?php

// Application settings
define('APP_NAME', 'SkillSwap');

// Try to auto-detect base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$dir = dirname($_SERVER['SCRIPT_NAME']);
// Remove '/public' from the end of the base URL if it's there
$dir = preg_replace('/\/public$/', '', $dir);
define('BASE_URL', $protocol . '://' . $host . $dir);

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'skillswap');
