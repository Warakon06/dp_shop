<?php 
// เรียกใช้ไฟล์สำหรับเชื่อมต่อฐานข้อมูล (PDO)
// ภายในไฟล์นี้จะมีตัวแปร $con สำหรับใช้ติดต่อกับฐานข้อมูล
include '../include/connect_db.php';
// เรียกใช้ไฟล์ที่เก็บฟังก์ชันหรือค่าตัวแปรที่ใช้ร่วมกันในระบบ
include '../include/function.php'; 

// ตรวจสอบว่ามีการส่งค่า id_del มาจากฟอร์ม (POST) หรือไม่
// id_del คือรหัสผู้ใช้งาน (account_id) ที่ต้องการลบ
if (!empty($_POST['id_del'])) {
	try {
		// เริ่มต้น Transaction
		// เพื่อให้การลบข้อมูลทำงานแบบสมบูรณ์ (สำเร็จทั้งหมดหรือยกเลิกทั้งหมด)
		$con->beginTransaction();
		// คำสั่ง SQL สำหรับลบข้อมูลผู้ใช้งานออกจากตาราง user_account
		// โดยใช้เงื่อนไข account_id ที่รับมาจากฟอร์ม
		$query = 'DELETE FROM user_account WHERE account_id = :id_del';
		// เตรียมคำสั่ง SQL ด้วย PDO (Prepared Statement)
		$result = $con->prepare($query);
		// ผูกค่าที่ส่งมาจากฟอร์ม ($_POST['id_del']) 
		// เข้ากับตัวแปร :id_del ในคำสั่ง SQL
		$result->execute([
			'id_del' => $_POST['id_del']
		]);
		// ยืนยันการทำงาน (บันทึกการลบข้อมูลลงฐานข้อมูล)
		$con->commit();
		// ส่งค่ากลับไปแจ้งว่าลบข้อมูลสำเร็จ
		echo 'true';
	} catch (PDOException $e) {
		// หากเกิดข้อผิดพลาดระหว่างการลบข้อมูล
		// จะยกเลิกการทำงานทั้งหมด (ย้อนกลับสถานะเดิม)
		$con->rollBack();
		// แสดงหรือบันทึกข้อความ error (ในที่นี้ไม่ได้แสดงออกมา)
		$e->getMessage();
		// ส่งค่ากลับไปแจ้งว่าลบข้อมูลไม่สำเร็จ
		echo 'false';
	}
}
?>
