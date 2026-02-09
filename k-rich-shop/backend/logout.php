<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 
?>
<meta charset="utf-8">
<?php 
unset($_SESSION['sess_id']);
unset($_SESSION['role']);
unset($_SESSION['role_name']);
unset($_SESSION['fullname']);

session_regenerate_id();

gotopage('index.php');
?>