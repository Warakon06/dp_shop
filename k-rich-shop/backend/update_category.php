<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	//การเริ่มต้น Trasaction
	$con->beginTransaction();
	//คิวรี่สำหรับบันทึกข้อมูล หมวดหมู่สินค้า
	$query = 'update category set name = :name where category_id = :cid ';
	$result = $con->prepare($query);
	//แทนค่า parameter
	$result->execute([
		'name' 	=> $_POST['name'],
		'cid'	=> $_POST['id_edit']
	]);
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
?>