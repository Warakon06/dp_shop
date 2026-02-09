<?php 
// เรียกใช้ไฟล์สำหรับเชื่อมต่อฐานข้อมูล (PDO)
// ภายในไฟล์จะมีตัวแปร $con ใช้สำหรับติดต่อฐานข้อมูล
include '../include/connect_db.php';
// เรียกใช้ไฟล์ที่เก็บฟังก์ชันและตัวแปรที่ใช้ร่วมกันในระบบ
include '../include/function.php'; 

try {
	// เริ่มต้น Transaction
	// เพื่อให้การทำงานหลายคำสั่ง SQL สำเร็จหรือยกเลิกพร้อมกัน
	$con->beginTransaction();
	// ดึงรายละเอียดสินค้าทั้งหมดจากตาราง orders_detail
	// โดยอ้างอิงจาก orders_id ที่ส่งมาจากฟอร์ม
	$query = 'SELECT * FROM orders_detail WHERE orders_id = :orid';
	$result = $con->prepare($query);
	// ผูกค่า orders_id ที่ต้องการยกเลิกคำสั่งซื้อ
	$result->execute([
		'orid' => $_POST['id_cncl']
	]);
	// ตรวจสอบว่าพบรายการสินค้าในคำสั่งซื้อหรือไม่
	if ($result->rowCount() > 0) {
		// วนลูปทีละรายการสินค้าในคำสั่งซื้อ
		foreach ($result as $key => $rs) {
			// ดึงข้อมูลสินค้าจากตาราง product ตาม product_id
			$query2 = 'SELECT * FROM product WHERE product_id = :pid';
			$result2 = $con->prepare($query2);
			$result2->execute([
				'pid' => $rs['product_id']
			]);
			// ดึงข้อมูลสินค้าออกมาเป็น array
			$rs2 = $result2->fetch();

			// ตรวจสอบกรณีจำนวนสินค้าเป็น -1
			// (อาจหมายถึงสินค้าไม่จำกัดจำนวน)
			if ($rs2['amount'] == '-1') {
				// ไม่ต้องปรับปรุง stock
			} else {
				// คำนวณจำนวนสินค้าใหม่
				// stock เดิม + จำนวนสินค้าที่ถูกยกเลิก
				$stock = $rs2['amount'] + $rs['amount'];
				// อัปเดตจำนวนสินค้า (stock) กลับเข้าคลัง
				$query3 = 'UPDATE product SET amount = :amt WHERE product_id = :pid';
				$result3 = $con->prepare($query3);
				$result3->execute([
					'amt' => $stock,
					'pid' => $rs['product_id']
				]);
			}

			// เปลี่ยนสถานะคำสั่งซื้อในตาราง orders
			// status = 6 หมายถึง "ยกเลิกคำสั่งซื้อ"
			$query4 = 'UPDATE orders SET status = 6 WHERE orders_id = :orid';
			$result4 = $con->prepare($query4);
			$result4->execute([
				'orid' => $_POST['id_cncl']
			]);
		}
	}
	// ยืนยันการทำงานทั้งหมดใน Transaction
	$con->commit();
	// ส่งค่ากลับไปแจ้งว่าการยกเลิกคำสั่งซื้อสำเร็จ
	echo 'true';
} catch (PDOException $e) {
	// หากเกิดข้อผิดพลาดระหว่างการทำงาน
	// จะย้อนกลับการเปลี่ยนแปลงทั้งหมด
	$con->rollBack();
	// แสดงข้อความ error (ใช้สำหรับ debug)
	echo $e->getMessage();
	// ส่งค่ากลับไปแจ้งว่าการทำงานล้มเหลว
	echo 'false';
}
?>
