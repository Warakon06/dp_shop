<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

try {
	$con->beginTransaction();
	//บันทึกข้อมูบลการรับสินค้า
	$query = 'update orders set 
		status = 5, get_orders_date = current_date() 
		where orders_id = :orid ';
	$result = $con->prepare($query);
	$result->execute(['orid' => $_POST['orders_id']]);
	$con->commit();

	foreach ($_POST['proid'] as $key => $value) {
		//บันทึกข้อมูลีวิวและคะแนนสินค้า
		$query2 = 'insert into review_product value(NULL, :orid, :pid, :mid, :score, :comment)';
		$result2 = $con->prepare($query2);
		$result2->execute([
			'orid'		=> $_POST['orders_id'], 
			'pid'		=> $_POST['proid'][$key],
			'mid'		=> $_POST['member_id'],
			'score'		=> $_POST['score'][$key],
			'comment'	=> $_POST['comment'][$key]
		]);
	}

	//ไปที่หน้ารายการสั่งซื้อ
	gotopage('my_orders.php?act=save_get_success');
//ถ้ามี error
} catch (PDOException $e) {
	$con->rollBack();
	echo $con-getMessage();

	gotopage('my_orders.php');
}
?>