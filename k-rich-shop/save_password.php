<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ดึงข้อมูลสมาชิก
$query = 'select * from member where member_id = :mid ';
$result = $con->prepare($query);
$result->execute(['mid' => $_SESSION['member_id']]);
if ($result->rowCount()>0) {
	$rs = $result->fetch();

	//ตรวจสอบรัสผ่านเดิม
	$verify_password = password_verify($_POST['oldpass'], $rs['password']);

	//ถ้ารหัสผ่านเดิมตรงกัน
	if ($verify_password) {
		try {
			$con->beginTransaction();
			//อัปเดทรหัสผ่านใหม่
			$query = 'update member set password = :npass where member_id = :mid ';
			$result = $con->prepare($query);
			$result->execute([
				'npass'	=> password_hash($_POST['newpass1'],  PASSWORD_BCRYPT, ['cost' => 10]), 
				'mid'	=> $_SESSION['member_id']
			]);
			$con->commit();

			//ไปที่หน้าเปลี่ยนรหัสผ่าน
			gotopage('change_password.php?act=save_success');
		//ถ้ามี error
		} catch (PDOException $e) {
			$con->rollBack();
			echo $e->getMessage();

			//ไปที่หน้าเปลี่ยนรหัสผ่าน
			gotopage('change_password.php?act=save_error');
		}
	//ถ้ารหัสผ่านเดิมไ่ตรงกัน
	} else {
		//ไปที่หน้าเปลี่ยนรหัสผ่าน
		gotopage('change_password.php?act=wrong_old_pass');
	}
}
?>