<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include '../include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include '../include/function.php'; 

if (!empty($_POST['orid']) and !empty($_POST['status'])) {
	try {
		$con->beginTransaction();
		$query = 'update orders set status = :status where orders_id = :orid ';
		$result = $con->prepare($query);
		$result->execute([
			'status'	=> $_POST['status'],
			'orid'		=> $_POST['orid']
		]);
		$con->commit();

		if ($_POST['status']==1) {
			$query2 = 'select 
				a.amount, a.product_id, 
				b.amount as product_amount 
				from orders_detail as a 
				left outer join product as b on a.product_id = b.product_id 
				where a.orders_id = :orid ';
			$result2 = $con->prepare($query2);
			$result2->execute(['orid' => $_POST['orid']]);
			if ($result2->rowCount()>0) {
				foreach ($result2 as $key => $value) {
					if ($value['product_amount']!='-1') {
						$query3 = 'update product set amount = :amt where product_id = :pid ';
						$result3 = $con->prepare($query);
						$result->execute([
							'amt'	=> ($value['product_amount'] + $value['amount']),
							'pid'	=> $value['product_id']
						]);
					}
				}
			}
		}

		echo 'true';
	} catch(PDOException $e) {
		$con->rollBack();
		echo $e->getMessage();

		echo 'false';
	}
} else {
	echo 'false';
}
?>