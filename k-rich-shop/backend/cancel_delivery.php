<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	//การเริ่มต้น Trasaction
	$con->beginTransaction();
	//คิวรี่สำหรับบันทึกข้อมูล กหารจัดส่งสินค้า
	$query = 'update orders set delivery_date = NULL, 
	delivery_time = NULL, delivery_track = NULL, 
	status = 3 
	where orders_id = :orid ';
	$result = $con->prepare($query);
	//แทนค่า parameter
	$result->execute(['orid' => $_POST['orders_id']]);
	//ยืนยันกระบวนการการเปลี่ยนข้อมูล
	$con->commit();
	
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า delivery และแสดงกล่องข้อความ
	echo 'true';
} catch(PDOException $e) {
	//ดึงข้อมูลกับไปตอนที่เริ่ม
	$con->rollBack();
	//เก็บค่าเออเร่อแมสเซส
	echo $e->getMessage();
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า prepare และแสดงกล่องข้อความ
	echo 'false';
}
?>