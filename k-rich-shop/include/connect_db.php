<?php
// Last Updated: Fix Conflict Markers
session_start();
ob_start();

// 1. ลองดึงค่าจาก Render (Server)
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

// 2. ถ้าดึงไม่ได้ ให้ใช้ค่า Local (เครื่องตัวเอง)
if (empty($host)) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'db_shop';
}

try {
    $con = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

date_default_timezone_set("Asia/Bangkok");
?>