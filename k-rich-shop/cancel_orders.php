<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ดึงข้อมูลรายละเอียดการสั่งซื้อ
$query = 'select * from orders_detail where orders_id = :orid ';
$result = $con->prepare($query);
$result->execute(['orid' => $_POST['id_cncl']]);

//ถ้ามีข้อมูลการสั่งซื้อ
if ($result->rowCount()>0) {
	foreach ($result as $key => $value) {
		//ดึงข้อมูลสินค้า
		$query2 = 'select * from product where product_id = :pid ';
		$result2 = $con->prepare($query2);
		$result2->execute(['pid'  => $value['product_id']]);
		$rs2 = $result2->fetch();

		//ถ้าเป็นสินค้าที่ไม่จำกัดจำนวน
		if ($rs2['amount']=='-1') {
		//ถ้าเป็นสินค้าที่จำกัดจำนวน
		} else {
			//เอาจำนวนสินค้าคืนสต็อก
			$stock = $rs2['amount'] + $value['amount'];

			//อัปเดทข้อมูลสินค้า
			$query3 = 'update product set amount = :amt where product_id = :pid ';
			$result3 = $con->prepare($query3);
			$result3->execute([
				'amt'	=> $stock,
				'pid'	=> $value['product_id']
			]);
		}

		//อัปเดทข้อมูลการสั่งซื้อ
		$query4 = 'update orders set status = 6 where orders_id = :orid ';
		$result4 = $con->prepare($query4);
		$result4->execute(['orid' => $_POST['id_cncl']]);
	}
	echo 'true';
}
?>