<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

try {
	$con->beginTransaction();

	$query = 'update orders set status = :status,
	 shop_comment = :comment where orders_id = :orid ';
	$result = $con->prepare($query);
	$result->execute([
		'status' 	=> $_POST['status'], 
		'comment' 	=> $_POST['comment'], 
		'orid' 		=> $_POST['orders_id'] 
	]);
	$con->commit();

	if ($_POST['status']==7) {
		$query2 = 'select * from orders_detail where orders_id = :orid ';
		$result2 = $con->prepare($query2);
		$result2->execute(['orid' => $_POST['orders_id']]);
		if ($result2->rowCount()>0) {
			foreach ($result2 as $key => $rs2) {
				$query3 = 'select * from product where product_id = :pid ';
				$result3 = $con->prepare($query3);
				$result3->execute(['pid'  => $rs2['product_id']]);
				$rs3 = $reuslt3->fetch();

				if ($rs3['amount']=='-1') {
				} else {
					$stock = $rs3['amount'] + $rs2['amount'];

					$query4 = 'update product set amount = :amt where product_id = :pid ';
					$result4 = $con->prepare($query4);
					$result4->execute([
						'amt'	=> $stock,
						'pid'	=> $rs2['product_id']
					]);
				}
			}
		}
	}

	gotopage('return_orders.php?act=save_success');
} catch (PDOException $e) {
	$con->rollBack();
	echo $e->getMessage();
	gotopage('return_orders.php?act=save_error');
}
?>