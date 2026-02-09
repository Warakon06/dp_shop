<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

try {
	$con->beginTransaction();
	//บันทึกข้อมูลการขอคืนสินค้า
	$query = 'update orders set 
		return_orders_reason = :reason
		where orders_id = :orid ';
	$result = $con->prepare($query);
	$result->execute([
		'reason'	=> $_POST['reason'],
		'orid' 		=> $_POST['orders_id']
		]);
	$con->commit();

	//ไปที่หน้รายการสั่งซื้อ
	gotopage('my_orders.php?act=save_get_success');
//ถ้า error
} catch (PDOException $e) {
	$con->rollBack();
	echo $con-getMessage();

	//ไปที่หน้รายการสั่งซื้อ
	gotopage('my_orders.php');
}
?>