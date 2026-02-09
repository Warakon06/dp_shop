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
		$query = 'delete from product where product_id = :pid ';
		$result = $con->prepare($query);
		//แทนค่า parameter
		$result->execute(['pid'  => $_POST['id_del']]);
		//ยืนยันกระบวนการการเปลี่ยนข้อมูล
		$con->commit();

		//ลบรูปภาพสินค้าทั้งหมดด้วย
		$query2 = 'delete from product_photo where product_id = :pid ';
		$result2 = $con->prepare($query2);
		//แทนค่า parameter
		$result2->execute(['pid' => $_POST['id_del']]);

		//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
		echo 'true';
	} catch(PDOException $e) {
		//ดึงข้อมูลกับไปตอนที่เริ่ม
		$con->rollBack();
		//เก็บค่าเออเร่อแมสเซส
		$e->getMessage();
		//เรียกใช้ function gotopage ให้กลับไปที่หน้า product และแสดงกล่องข้อความ
		echo 'false';
	}

} else {
	//เรียกใช้ function gotopage ให้กลับไปที่หน้า product
	gotopage('product.php');
}
?>