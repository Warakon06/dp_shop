<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

//
if (!empty($_POST['id_del'])) {
	try {
		//การเริ่มต้น Trasaction
		$con->beginTransaction();
		$query = 'delete from category where category_id = :cid ';
		$result = $con->prepare($query);
		//แทนค่า parameter
		$result->execute(['cid'  => $_POST['id_del']]);
		//ยืนยันกระบวนการการเปลี่ยนข้อมูล
		$con->commit();

		//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
		echo 'true';
	} catch(PDOException $e) {
		//ดึงข้อมูลกับไปตอนที่เริ่ม
		$con->rollBack();
		//เก็บค่าเออเร่อแมสเซส
		$e->getMessage();
		//เรียกใช้ function gotopage ให้กลับไปที่หน้า category และแสดงกล่องข้อความ
		echo 'false';
	}

} else {
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า category
	gotopage('category.php');
}
?>