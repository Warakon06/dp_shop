<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//
if (!empty($_GET['id_del'])) {
	try {
		//การเริ่มต้น Trasaction
		$con->beginTransaction();
		$query = 'delete from product_photo where photo_id = :pid ';
		$result = $con->prepare($query);
		//แทนค่า parameter
		$result->execute(['pid'  => $_GET['id_del']]);
		//ยืนยันกระบวนการการเปลี่ยนข้อมูล
		$con->commit();

		//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
		gotopage('product.php');
	} catch(PDOException $e) {
		//ดึงข้อมูลกับไปตอนที่เริ่ม
		$con->rollBack();
		//เก็บค่าเออเร่อแมสเซส
		$e->getMessage();
		//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
		gotopage('product.php');
	}

} else {
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า product
	gotopage('product.php');
}
?>