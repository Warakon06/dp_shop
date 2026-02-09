<?php
session_start();
ob_start();

// 1. ลองดึงค่าจาก Render (Environment Variable)
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

// 2. ถ้าดึงค่าไม่ได้ (แปลว่ารันในเครื่องตัวเอง XAMPP) ให้ใช้ค่าเดิม
if (!$host) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'db_shop';
}

try {
    // เชื่อมต่อฐานข้อมูล
    $con = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

date_default_timezone_set("Asia/Bangkok");
?>