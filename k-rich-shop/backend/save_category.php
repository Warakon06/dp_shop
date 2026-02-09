<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//คิวรี่เพื่อเช็คว่ามีชื่อหมวดหมู่สินค้านี้อยูแล้วหรือยัง
$query = 'select * from category where name = :name ';
$result = $con->prepare($query);
$result->execute(['name' => $_POST['name']]);
//ถ้าชื่อหมวดหมู่สินค้าซ้ำ
if ($result->rowCount()>0) {
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
	gotopage('category.php?act=save_duplicate');
//ถ้ายังไม่มีชื่อหมวดหมู่สินค้า
} else {
	try {
		//การเริ่มต้น Trasaction
		$con->beginTransaction();
		//คิวรี่สำหรับบันทึกข้อมูล หมวดหมู่สินค้า
		$query = 'insert into category value(NULL, :name)';
		$result = $con->prepare($query);
		//แทนค่า parameter
		$result->execute(['name' => $_POST['name']]);
		//ยืนยันกระบวนการการเปลี่ยนข้อมูล
		$con->commit();
		
		//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
		gotopage('category.php?act=save_success');
	} catch(PDOException $e) {
		//ดึงข้อมูลกับไปตอนที่เริ่ม
		$con->rollBack();
		//เก็บค่าเออเร่อแมสเซส
		$e->getMessage();
		//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
		gotopage('category.php?act=save_error');
	}
}
?>