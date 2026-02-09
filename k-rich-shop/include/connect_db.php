<?php
//เริ่มใช้ session
session_start(); 
ob_start();

$host = 'localhost';//ชื่อ Host ฐานข้อมูล
$user = 'root';//ชื่อผู้ใช้งานฐานข้อมูล
$pass = '';//รหัสผ่านเข้าฐานข้อมูล
$db = 'db_shop';//ชื่อฐานข้อมูล

//function สำหรับเชื่อมต่อฐานข้อมูล
try {
<<<<<<< HEAD
     $con = new PDO("mysql:host=".$host."; dbname=".$db."", $user, $pass,
	array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
=======
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"  // <--- ตัวปัญหา
));
>>>>>>> e835878686405c49fefa5f8179ed27c3e5c77225
	//กำหนดการเชื่อมต่อแบบ utf-8 (เวลาสร้างไฟล์ก็ใช้การเข้ารหัสอักขระ utf-8 ด้วยครับ)
//ดักจับ ERROR แล้วเก็บไว้ใน $e
} catch (PDOException $e){
    echo $e->getMessage();# แสดงออกมาหน้าจอ
}

//Settimezone เป็นประเทศไทย (วันที่และเวลา)
date_default_timezone_set("Asia/Bangkok");
?>
