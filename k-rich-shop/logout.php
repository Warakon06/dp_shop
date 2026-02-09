<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ทำลายตัวแปร session
unset($_SESSION['sess_id']);
unset($_SESSION['member_id']);
unset($_SESSION['member_name']);

session_destroy();

//ไปที่หน้าแรก
gotopage('index.php');
?>