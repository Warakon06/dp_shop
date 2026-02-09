<?php 
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ตรวจสอบว่ามีการส่งค่า email กับ password มาหรือไม่
if (!empty($_POST['email']) and !empty($_POST['pass'])) {
	//คิวรี่เพื่อตรวจสอบข้อมูล email
	$query = 'select member_id, email, password from member where email = :email ';
	$result = $con->prepare($query);
	$result->execute(['email' => $_POST['email']]);

	//ถ้ามีข้อมูล
	if ($result->rowCount()>0) {
		$rs = $result->fetch();
		//ตรวจสอบรหัสผ่านที่ป้อนเข้ามาด้วยการเข้ารหัส
		$verify_password = password_verify($_POST['pass'], $rs['password']);
		//ถ้า email และ password ตรงกับข้อมูลในฐานข้อมูล
		if ($verify_password) {
			//คิวรี่ดึงข้อมูลสมาชิก
			$query = 'select * from member where member_id = :mid ';
			$result = $con->prepare($query);
			$result->execute(['mid'  => $rs['member_id']]);

			if ($result->rowCount()>0) {
				$rs = $result->fetch();
				//เก็บข้อมูลสมาชิกไว้ในตัวแปร session
				$_SESSION['sess_id'] = session_id();
				$_SESSION['member_id'] = $rs['member_id'];
				$_SESSION['member_name'] = $rs['first_name'].' '.$rs['last_name'];

				//เข้าสู่ระบบสำเร็จ และกลับไปที่ หน้าแรก
				gotopage('index.php');
			} else {
				//เข้าสู่ระบบไม่สำเร็จ กลับไปที่หน้า login
				gotopage('login.php?act=login_error');
			}
		} else {
			//เข้าสู่ระบบไม่สำเร็จ กลับไปที่หน้า login
			gotopage('login.php?act=login_error');
		}
	} else {
		//เข้าสู่ระบบไม่สำเร็จ กลับไปที่หน้า login
		gotopage('login.php?act=login_error');
	}
} else {
	//กลับไปที่หน้า login
	gotopage('login.php');
}
?>