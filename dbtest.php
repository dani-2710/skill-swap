<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';
$db = \App\Core\Database::getInstance()->getConnection();
$stmt = $db->query("SELECT * FROM skills");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
